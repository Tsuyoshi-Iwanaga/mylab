<?php

$name = $_POST["name"];
$gender = $_POST["gender"];
$age = $_POST["age"];

//チェックボックスは配列で渡ってくる
if (isset($_POST['interest']) && is_array($_POST['interest'])) {
  $interest = implode("/", $_POST["interest"]);
}

$free = $_POST["free"];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>アンケート(確認)</title>
<link rel="stylesheet" href="./reset.css">
<link rel="stylesheet" href="./style.css">
</head>
<body>
  <div class="l-wrap">
    <h1 class="p-title">フォームから入力された内容を画面に出力</h1>
    <div class="p-formBlock">
      <div class="p-formItem">
        <h2>お名前</h2>
        <p><?php print(${name}); ?></p>
      </div>
      <div class="p-formItem">
        <h2>性別</h2>
        <p><?php print(${gender}); ?></p>
      </div>
      <div class="p-formItem">
        <h2>年齢</h2>
        <p><?php print(${age}); ?></p>
      </div>
      <div class="p-formItem">
        <h2>興味がある分野</h2>
        <p><?php print(${interest}); ?></p>
      </div>
      <div class="p-formItem">
        <h2>メッセージ</h2>
        <p><?php print(${free}); ?></p>
      </div>
    </div>
    <p class="p-returnLink"><a href="./index.html">← 戻る</a></p>
  </div>
</body>
</html>