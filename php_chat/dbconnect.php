<?php
try {
  $db = new PDO('mysql:dbname=my_php_chat;host=127.0.0.1;charset=utf8', 'test01', '1nagak1sak1');
} catch (PDOException $e) {
  echo 'DB接続エラー:' .$e->getMessage();
}
?>
