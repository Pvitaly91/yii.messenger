<?

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use app\models\ContactList;
use app\models\Message;
use app\models\MessageForm;

class ContactController extends Controller {
    use \app\models\Controller;
    /**
    * contacts list for current users
    * @return type
    */
    public function actionList() {
        if (Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $users = User::find()->innerJoin('contact_list', 'contact_list.contact_id = user.id')->where("contact_list.user_id =" . User::id())->all();
        foreach ($users as $user) {
           
            $user->makeOnlineStatus();
            $user->getUnreadCountMsg($user->id);
        }
        $non_contact_users = User::getInvitedUsers();

        return $this->render("list", ["users" => $users,"non_contact" => $non_contact_users]);
    }
    /**
    * add user to contact list
    * @param type $id
    * @return type
    */
    public function actionAdd($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
     
        $user_id = User::id();

        if ($user_id != $id && User::exists($id) && !ContactList::find()->where(["contact_id" => $id, "user_id" => $user_id])->exists()) {
            $model = new ContactList();
            $model->contact_id = $id;
            $model->user_id = $user_id;
            if($model->save()){
                \Yii::$app->getSession()->setFlash('success', Yii::t("app",'User successfully added to you contact list'));
            }
        }
        return $this->goHome();
    }

    public function actionSend($id) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::find()->innerJoin('contact_list', 'contact_list.contact_id = user.id')->where('user.id=' . $id)->exists()) {

            $form = new MessageForm();
            if (Yii::$app->request->post("MessageForm")) {
                $form->attributes = Yii::$app->request->post("MessageForm");
                $form->send($id); // add message to DB 
            }
            return $this->redirect("/contact/chat?id=" . $id);
            
        }
    }
    
    public function actionChat($id) {
      
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        if(ContactList::find()->where("user_id=".User::id()." AND contact_id=".$id)->exists()){ //if user in your contact list
            $message = new Message();
            $form = new MessageForm();
            $messages = $message->getHistory($id); // hystory of messages
            $message->setReadStatus($id);
            return $this->render('messages', [
                        'mess' => $messages,
                        'form' => $form,
                        'destination_id' => $id
            ]);
        }else{
            $this->setPage404();
        }
    }

}
