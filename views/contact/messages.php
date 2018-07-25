<?

use app\models\User;
use \yii\widgets\ActiveForm; 
?>
<h1>messages</h1>
<? d($mess); ?>
<style>
    .message{
        border:1px solid #bbb;
        padding: 15px;
        border-radius:15px;
        background-color: white; 
        margin-top:15px;
        text-align: justify;
    }  
    .m-left{
        margin-right: 200px;

    }
    .m-right{
        margin-left: 200px;
        text-align: right;

    }

    .m-right .m-header{
        text-align: right;

    }
    .m-left .m-header{

    }

    .m-right .m-footer{
        text-align: right;
    }
    .m-body{
        background-color:#ccc;
        overflow-y: scroll;
        height: 500px !important;
    }
    .m-form{
        margin-top: 15px;
    }
    .m-form textarea{
        height: 120px;
    }
    .m-btn{
        padding: 8px 45px;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-12  m-body"  >
        <? foreach ($mess as $m): ?>
            <?
            User::id() == $m["user_id"] ? $class = "m-left" : $class = "m-right";
            $m["seen"] ? $seen = "seen" : $seen = "sent";
            ?>
            <div class="message <?= $class ?>">
                <p class="m-header"><strong><?= $m["username"] ?></strong><span> <?= $m["time"] ?></span><br>
                <p><?= $m["message"] ?></p>
                <? if(User::id() == $m["user_id"] ):?>
                    <p class="m-footer"><strong><small><?= $seen ?></small></strong></p>
                <? endif;?>    
            </div>
<? endforeach; ?>

    </div>
</div>
<div class="m-form">
    <? $f = ActiveForm::begin(["class" => 'form-horizontal','action'=>"/contact/send?id=".$destination_id]);?>
        <div class="form-group">
            <div class="col-sm-12">
                <?=$f->field($form, 'message')->textarea(['autofocus'=> true ,"placeholder" =>"type your message"])?>
            </div>
        </div>
        <div class="form-group"> 
            <div class=" col-sm-10">
                <button type="submit" class="btn btn-success m-btn">Send</button>
            </div>
        </div>
    <? ActiveForm::end();?>
</div>