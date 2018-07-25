<?


if(isset($msg_success)):?>
    <div class="alert alert-success">
        <strong><? echo yii::t("app", "Success!")?></strong> <?=$msg_success;?>
    </div>
<? endif;?>
