<?php
ini_set('display_errors', "On");
require_once(__DIR__ . '/classes/utility/page_process.php');
?>
<html>
<head>
<title>PHP講座トップページ</title>
</head>
<body>
<h1>PHP講座2</h1>
<p>あなたは<?php echo $data['counter_value'] * 2; ?>番目の訪問者です</p>
</body>
</html>