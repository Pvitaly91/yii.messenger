<?

namespace app\controllers;

use yii;
use app\models\User;
use app\models\Signup;
use yii\web\Controller;

class UserController extends Controller {

    use \app\models\Controller;

    /**
     *  set online status for current authorized user
     */
    public function actionOnline() {
        if (Yii::$app->request->isAjax) {
            User::setOnline();
        }
    }
    /**
     * action user profile
     * @param type $id
     * @return type
     */
    public function actionProfile($id) {
        $data = [];
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = User::find()
                ->where(["id" => $id])
                ->select(['id', 'username', 'status', 'online_status', 'email'])
                ->all();
        if (isset($user[0])) {
            $user = $user[0];
            $user->makeOnlineStatus();
            $data["user"] = $user;
            $data["id"] = $id;
        }
       
        else {
            $this->setPage404();
        }
        
        if($id== User::id()){
            //show form for change password
            $model = new Signup();
            $model->setRulesName("change_pass");
            if(Yii::$app->request->post('Signup')){
                $model->attributes = Yii::$app->request->post('Signup'); 
                if($model->validate() && $model->ChangePass($id)){ 
                     \Yii::$app->getSession()->setFlash('success', 'New password saved');
                } 
            }
            $data["pass_form"] = $model;
        }
        return $this->render("profile", $data);
    }
    

    /**
    *   editing page status for current user
    *   @param type $id
    *   @return type
    */
    public function actionEdit($id) {
        if($id != User::id()){ //we can change only yourself status
            $this->setPage404();
        }
        $user = User::find()->select(["status", "id"])->where(["id" => $id])->all();
        if (isset($user[0])) {
            $user = $user[0];
        }else{
           $this->setPage404();
        }
        if (isset(\Yii::$app->request->post("User")["status"])) {
            $user->status = \Yii::$app->request->post("User")["status"];
            if ($user->update()) {
                \Yii::$app->getSession()->setFlash('success', 'Saved');
            }
        }
        return $this->render("edit", ['user' => $user]);
    }

}
