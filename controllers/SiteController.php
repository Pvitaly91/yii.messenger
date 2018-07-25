<?php

namespace app\controllers;

use Yii;
//use yii\filters\AccessControl;
use yii\web\Controller;
//use yii\web\Response;
//use yii\filters\VerbFilter;
//use app\models\LoginForm;
//use app\models\ContactForm;
use app\models\User;
use app\models\Signup;
use app\models\Login;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
  
    /**
     *  Action for registration new user
     */
    public function actionSignup() {
        if (Yii::$app->user->isGuest) {
            $model = new Signup();
            if ($model->attributes = Yii::$app->request->post('Signup')) {

                if ($model->validate() && $model->signup()) {
                    return $this->goHome();
                }
            }
            return $this->render('singup', ["model" => $model]);
        } else {
            return $this->render('singup');
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {// if user not authorized show him login form
            return $this->actionLogin(); // show login form
        }

        $users = User::find()->select("`user`.`id`, `username`, `status`, `online_status`")
                ->where('id != ' . User::id()) //not equal current user
                ->all();


        foreach ($users as $user) {
            $user->makeOnlineStatus(); // set onlin/offline status for user
        }

        return $this->render("user_list", ["users" => $users]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {

        $model = new Login();
        if (Yii::$app->request->post('Login')) {
            $model->attributes = Yii::$app->request->post('Login');
            if ($model->validate()) {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUserList() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $users = User::find()
                ->select(['id', 'username', 'status', 'online_status'])
                ->where('id != ' . User::id()) //not equal current user
                ->asArray()
                ->all();
        return $this->render("user_list", ["users" => $users]);
    }

}
