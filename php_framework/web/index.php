<?php
//アプリケーション実行

require_once '../bootstrap.php';
require_once '../MiniBlogApplication.php';

$app = new MiniBlogApplication(false);
$app->run();