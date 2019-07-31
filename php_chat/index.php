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
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_post_id=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message'],
      $_POST['reply_post_id']
    ));

    header('Location: index.php');
    exit();
  }
}

//投稿を表示
$posts = $db->query('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');

//返信の場合
if (isset($_REQUEST['res'])) {
  $response = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');
  $response->execute(array($_REQUEST['res']));

  $table = $response->fetch();
  $message = '@'. $table['name']. ' '. $table['message'];
}

//htmlspecialchars
function h($value) {
  return htmlspecialchars($value, ENT_QUOTES);
}

//URLリンクを作る
function makeLink($value) {
  return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)", '<a href="\1\2">\1\2</a>', $value);
}
?>
<div><a href="logout.php">ログアウト</a></div>
<form action="" method="post">
<dl>
  <dt><?php echo $member['name'] ?>メッセージをどうぞ</dt>
  <dd><textarea name="message" cols="50" rows="5"><?php echo h($message); ?></textarea></dd>
  <input type="hidden" name="reply_post_id" value="<?php echo h($_REQUEST['res'] ? $_REQUEST['res']: 0); ?>" />
</dl>
<div>
  <input type="submit" value="投稿する">
</div>
</form>
<?php
  foreach ($posts as $post):
?>
<div class="msg" style="border-bottom: 1px solid #eee">
  <img src="member_picture/<?php echo h($post['picture']); ?>" width="48" height="48">
  <p><?php echo makeLink(h($post['message'])); ?><span class="name">(<?php echo h($post['name']); ?>)</span>[<a href="index.php?res=<?php echo h($post['id']); ?>">Re</a>]</p>
  <p class="day"><a href="view.php?id=<?php echo h($post['id']); ?>"><?php echo h($post['created']); ?></a>
  <?php
    if($post['reply_post_id'] > 0):
  ?>
  <a href="view.php?id=<?php echo h($post['reply_post_id']); ?>">返信元のメッセージ</a>
  <?php endif; ?>
    [<a href="delete.php?id=<?php echo h($post['id']); ?>">削除</a>]
  <?php
    if($_SESSION['id'] === $post['member_id']):
  ?>
  <?php endif; ?>
  </p>
</div>
<?php
  endforeach;
?>
