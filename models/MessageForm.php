<?php

namespace app\models;

use yii\base\Model;
use app\models\Message;
use app\models\User;
class MessageForm extends Model {

    public $message;

    public function rules() {
        return [
            [['message'], 'required'],
        ];
    }

    public function send($destination_id) {
        $msg = new Message();
        $msg->message = $this->message;
        $msg->destination_id = $destination_id;
        $msg->user_id = User::id();
        $msg->time = User::currTime();
        $msg->save();
    }

}
