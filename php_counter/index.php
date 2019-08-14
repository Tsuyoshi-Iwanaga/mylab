<?php
ini_set('display_errors', "On");

require_once('./classes/counter/Counter.php');

$counter = new Counter();
$counter->increment();
$cnt = $counter->get();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カウンター</title>
</head>
<body>
<h1>訪問者カウンター</h1>
<p>あなたは<?=$cnt?>番目の訪問者です</p>
</body>
</html>