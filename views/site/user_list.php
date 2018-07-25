<?

?>
<h1><?=Yii::t("app","User list")?></h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User name</th>
      <th scope="col">status</th>
      <th scope="col">online</th>
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
          <td><a href="/contact/add?id=<?=$user["id"]?>">add to contact list</a></td>
        </tr>
    <? endforeach;?>
  </tbody>
</table>
