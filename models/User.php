<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Message;
use app\models\ContactList;

class User extends ActiveRecord implements IdentityInterface {
    const ONLINE_DELAY = "10";
    public $unread_count_msg;
    public $total_unread_count_msg;
    
    public function setPassword($password) {
        return sha1($password);
    }

    public function validatePassword($password) {
        return $this->password === $this->setPassword($password);
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }
    public function getId(){
        return $this->id;
    }
    /**
     *  get current authorized user id
     */
    public static function id(){
        return yii::$app->user->getId();
    }
    
    public static function getInvitedUsers(){
        
        $result = Message::find()->select("user_id")->where("destination_id =".User::id()." AND seen IS NULL")->distinct()->all();
  
        if(is_array($result)){
            foreach($result as $user){
                $userIds[] = $user->user_id;
            }
            if(isset($userIds))
                {
                $non_contact_users = ContactList::find()
                             ->select('user.username,user.id')
                             ->innerJoin('user',' user.id=contact_list.user_id')
                             ->where("contact_id =".User::id()." AND user_id IN (".implode(",",$userIds).") AND "
                                     ." contact_id NOT IN (".implode(",",$userIds).") AND  user_id!=".User::id())
                             ->asArray()
                             ->all();
                d($non_contact_users);
                 return $non_contact_users;  
            }
        }
        
    }
    /**
     * set online status like string
     */
    public function makeOnlineStatus(){

       if(time()-strtotime($this->online_status)<= User::ONLINE_DELAY){
           $this->online_status = "<strong>".\Yii::t('app', 'online')."</strong>";
       }else{
           $this->online_status = \Yii::t('app', 'offline');
       }
       
    }
    public static function currTime(){
        return date("Y-m-d H:i:s",time());
    }
    /**
     *  set online status to user
     */
    public static function setOnline(){
    
        $result = self::find()->select(["id", "online_status"])->where(['id' => User::id()])->all();
        if (isset($result[0]) && $result = $result[0]) {
            $result->online_status = self::currTime();
            $result->save();
        }
    }
    /**
     * checking if user exists
     * @param int $id
     * @return bool
     */
    public static function exists($id){
        return self::find()->where(["id" => $id])->exists();
    }
    /**
     * get count unread messages for user id
     * @param type $id
     */
    public function getUnreadCountMsg($id){
        if(User::id() != $id){
            $result = (new \yii\db\Query())->select("COUNT(*) AS count")->from("message")->where("user_id=".$id." AND destination_id=".User::id()." AND seen IS NULL")->all();
            if(isset($result[0]["count"])){
                 $this->unread_count_msg = $result[0]["count"];
            }
        }
     
    }
    
    public static function findIdentityByAccessToken($token, $type = null){}
    public function getAuthKey() {}
    public function validateAuthKey($authKey) {}
    
}
