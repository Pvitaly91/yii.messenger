<?
use app\models\User;
use \yii\widgets\ActiveForm;
?>

<h1><?=Yii::t("app","Profile")?></h1>
<ul class="list-group">
    <li class="list-group-item"><?=\Yii::t('app', 'User name');?>: <?=$user["username"]?></li>
    <li class="list-group-item"><?=\Yii::t('app', 'Status');?>: <?=$user["status"]?><? if(User::id() == $user["id"]):?> <a href="/user/edit?id=<?=$user["id"]?>" class="btn btn-info"><? isset($user["status"]) ? print(\Yii::t('app', 'change')) : print(\Yii::t('app', 'add'));?></a><? endif;?></li>
    <li class="list-group-item"><?=\Yii::t('app', 'Email');?>: <?=$user["email"]?></li>
    <li class="list-group-item"><?=\Yii::t('app', 'Online status');?>: <?=$user["online_status"]?></li>
</ul>
<? if(isset($pass_form)):?>
    <h3><?=Yii::t("app","Change password")?></h3>
    <?   $form = ActiveForm::begin(["class" => 'form-horizontal']);?>
    <?= $form->field($pass_form, 'password')->passwordInput(['autofocus' => true]) ?>
    <?= $form->field($pass_form, 'password_repeat')->passwordInput(['autofocus' => true]) ?>
    <div>
        <button type="submit" class="btn"><?=Yii::t("app","Save")?></button>
    </div>
    <? ActiveForm::end(); ?>
<? endif;?>