<?php
session_start();
require('dbconnect.php');

//ログイン確認
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  //ログインしている
  $_SESSION['time'] = time();

  $members = $db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  //ログインしていない
  header('Location: login.php');
  exit();
}

//投稿を記録する
if(!empty($_POST)) {
  if($_POST['message'] != '') {
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message']
    ));

    header('Location: index.php');
    exit();
  }
}

//投稿を表示
$posts = $db->query('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
?>
<form action="" method="post">
<dl>
  <dt><?php echo $member['name'] ?>メッセージをどうぞ</dt>
  <dd><textarea name="message" cols="50" rows="5"></textarea></dd>
</dl>
<div>
  <input type="submit" value="投稿する">
</div>
</form>
<?php
  foreach ($posts as $post):
?>
<div class="msg" style="border-bottom: 1px solid #eee">
  <img src="member_picture/<?php echo htmlspecialchars($post['picture'], ENT_QUOTES) ?>" width="48" height="48">
  <p><?php echo htmlspecialchars($post['message'], ENT_QUOTES) ?><span class="name">(<?php echo htmlspecialchars($post['name'], ENT_QUOTES) ?>)</span></p>
  <p class="day"><?php echo htmlspecialchars($post['created'], ENT_QUOTES) ?></p>
</div>
<?php
  endforeach;
?>
