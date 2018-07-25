<?

use \yii\widgets\ActiveForm;
?>
<h1><?= Yii::t("app", "Singup") ?></h1>
<?
if (isset($model)):
    $form = ActiveForm::begin(["class" => 'form-horizontal']);
    ?>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password_repeat')->passwordInput(['autofocus' => true]) ?>
    <div>
        <button type="submit" class="btn">Signup</button>
    </div>
    <? ActiveForm::end(); ?>
<? else:?>
    <div class="alert alert-success">
        <strong><? echo yii::t("app", "You are already authorized!")?></strong>
    </div>
<? endif; ?>