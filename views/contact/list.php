
<?

if($non_contact):?>
<h3><?=Yii::t("app","Requests to contact")?></h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?=Yii::t("app","User name")?></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
         <? $n =1;
         foreach ($non_contact as $id => $user):?> 
            <tr>
              <th scope="row"><?=$n++?></th>
              <td><a href="/user/profile?id=<?=$user["id"]?>"><?=$user['username']?></a></td>
              <td><a href="/contact/add?id=<?=$user["id"]?>"><?=Yii::t("app","add to contact list")?></a></td>
            </tr>
        <? endforeach;?>
      </tbody>
    </table>
    
<? endif;?>
<h3><?=Yii::t("app","My contact list")?></h3>
<?
if($users):
    ?><table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?=Yii::t("app","User name")?></th>
          <th scope="col"><?=Yii::t("app","status")?></th>
          <th scope="col"><?=Yii::t("app","online")?></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
         <? foreach ($users as $k => $user):?> 
            <tr>
              <th scope="row"><?=$k+1?></th>
              <td><a href="/user/profile?id=<?=$user['id']?>"><?=$user['username']?></a></td>
              <td><?=$user['status']?></td>
              <td><?=$user['online_status']?></td>
              <td><a href="/contact/send?id=<?=$user['id']?>"><?=Yii::t("app","send message")?> <? $user->unread_count_msg > 0 ? print("(".$user->unread_count_msg.")") : false;?></a></td>
            </tr>
        <? endforeach;?>
      </tbody>
    </table>
<? else:?>
<div class="alert alert-info">
  <strong><? echo \Yii::t('app', 'Empty!');?></strong> 
 
</div>
<? endif; ?>
