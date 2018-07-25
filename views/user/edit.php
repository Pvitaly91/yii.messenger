<? 

use yii\bootstrap\ActiveForm;

 require __DIR__."\..\msg.php";
?>
<h1><?=Yii::t("app","Change status")?></h1>
<div class="m-form">
    <? $f = ActiveForm::begin(["class" => 'form-horizontal']);?>
        <div class="form-group">
            <div class="col-sm-12">
                <?=$f->field($user, 'status')->textarea(['autofocus'=> true ,"placeholder" =>\Yii::t('app', 'Type your status')])?>
            </div>
        </div>
        <div class="form-group"> 
            <div class=" col-sm-10">
                <button type="submit" class="btn btn-success m-btn"><?=\Yii::t('app', 'save')?></button>
            </div>
        </div>
    <? ActiveForm::end();?>
</div>

