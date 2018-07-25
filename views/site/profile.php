<?
use app\models\User;

?>
<h1>Profile</h1>
<ul class="list-group">
    <li class="list-group-item"><?=\Yii::t('app', 'User name');?>: <?=$user["username"]?></li>
    <li class="list-group-item"><?=\Yii::t('app', 'Status');?>: <?=$user["status"]?><? if(User::id() == $user["id"]):?> <a href="/user/edit?id=<?=$user["id"]?>" class="btn btn-info"><? isset($user["status"]) ? print(\Yii::t('app', 'change')) : print(\Yii::t('app', 'add'));?></a><? endif;?></li>
    <li class="list-group-item"><?=\Yii::t('app', 'Email');?>: <?=$user["email"]?></li>
    <li class="list-group-item"><?=\Yii::t('app', 'Online status');?>: <?=$user["online_status"]?></li>
</ul>
