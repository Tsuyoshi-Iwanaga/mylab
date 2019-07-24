<?php
session_start();
require('../dbconnect.php');

//POST(送信されたとき)
if(!empty($_POST)) {

  $error = [];

  //nameが空
  if($_POST['name'] == '') {
    $error['name'] = 'blank';
  }
  //emailが空
  if($_POST['email'] == '') {
    $error['email'] = 'blank';
  }
  //パスワードが4文字以下
  if(strlen($_POST['password']) < 4) {
    $error['password'] = 'length';
  }
  //パスワードが空
  if($_POST['password'] == '') {
    $error['password'] = 'blank';
  }
  //アップロード画像の確認
  $fileName = $_FILES['image']['name'];
  if(!empty($fileName)) {
    $ext = substr($fileName, -3);
    if($ext != 'jpg' && $ext != 'png') {
      $error['image'] = 'type';
    }
  }
  //重複アカウントがないか確認
  if(empty($error)) {
    $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
    $member->execute(array($_POST['email']));
    $record = $member->fetch();
    if($record['cnt'] > 0) {
      $error['email'] = 'duplicate';
    }
  }

  //エラーがない場合は確認画面へ
  if(empty($error)) {
    $image = date('YmdHis'). $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/'. $image);

    $_SESSION['join'] = $_POST;
    $_SESSION['join']['image'] = $image;
    header('Location: check.php');
    exit();
  }
}
//書き直しの場合
if($_REQUEST['action'] == 'rewrite') {
  $_POST = $_SESSION['join'];
  $error['rewrite'] = true;
}
?>
<p>次のフォームに必要事項をご記入ください</p>
<form action="" method="post" enctype="multipart/form-data">
  <dl>
    <dt>ニックネーム<span class="required">必須</span></dt>
    <dd><input type="text" name="name" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES) ?>" /></dd>
    <?php if($error['name'] == 'blank'): ?>
    <p class="error" style="color:red;">* ニックネームを入力してください</p>
    <?php endif; ?>

    <dt>メールアドレス<span class="required">必須</span></dt>
    <dd><input type="text" name="email" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES) ?>" /></dd>
    <?php if($error['email'] == 'blank'): ?>
    <p class="error" style="color:red;">* メールアドレスを入力してください</p>
    <?php endif; ?>
    <?php if($error['email'] == 'duplicate'): ?>
    <p class="error" style="color:red;">* メールアドレスがすでに登録されています</p>
    <?php endif; ?>

    <dt>パスワード<span class="required">必須</span></dt>
    <dd><input type="password" name="password" size="10" maxlength="20" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES) ?>"/></dd>
    <?php if($error['password'] == 'blank'): ?>
    <p class="error" style="color:red;">* パスワードを入力してください</p>
    <?php endif; ?>
    <?php if($error['password'] == 'length'): ?>
    <p class="error" style="color:red;">* パスワードは4文字以内で入力してください</p>
    <?php endif; ?>

    <dt>写真など</dt>
    <dd><input type="file" name="image" size="35" /></dd>
    <?php if($error['image'] == 'type'): ?>
    <p class="error" style="color:red;">* .gifか.jpgの画像を指定してください</p>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
    <p class="error" style="color:red;">* 恐れ入りますが、画像は改めて指定してください</p>
    <?php endif; ?>
  </dl>
  <div><input type="submit" value="入力内容を確認する" /></div>
</form>
