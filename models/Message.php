<?
namespace app\models;

use yii;
use yii\db\ActiveRecord;
use app\models\User;
class Message extends ActiveRecord{
    /**
     * get chating history
     * @param type $destination_id
     * @return type
     */   
    public function getHistory($destination_id){
        return self::find()->select("message.id,user.username,message.destination_id,message.user_id,message.message,message.seen,message.time")
                ->innerJoin("user", "user.id=message.user_id")
                ->where('(message.user_id='.User::id().' OR message.destination_id='.User::id().') AND'
                        . '(message.user_id='.$destination_id.' OR message.destination_id='.$destination_id.')')
                ->orderBy(["id"=>"ASC"])
                ->asArray()
                ->all();
    }
    /**
     * set read status for unread messages for user destination id
     * @param type $id
     */
    public function setReadStatus($id){
        
        $msg = self::find()->select(["seen","id"])->where("user_id=".$id." AND destination_id=".User::id()." AND seen IS NULL")->all();
        if(is_array($msg)){
         //   d($msg);
            foreach($msg as $m){
             
                $m->seen = 1;
                $m->save();
           
            }
        }
    }

}

