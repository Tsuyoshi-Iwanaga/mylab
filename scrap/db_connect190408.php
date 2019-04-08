<?php
try {
  $db = new PDO('mysql:dbname=mydb;host=127.0.0.1;charset=utf-8'. 'root', '');
} catch (PDOException $e) {
  echo('DB接続エラー'. $e->getMessage());
}

$count = $db->exec('INSERT INTO my_items SET maker_id=1, item_name="peach", price=210');
echo $count. '件のデータを挿入しました。'
