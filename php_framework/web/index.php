<?php
//アプリケーション実行

ini_set('display_errors', 'On');

require_once '../bootstrap.php';
// require_once '../MiniBlogApplication.php';

// $app = new MiniBlogApplication(false);
// $app->run();

$rec = new Session();
var_dump($_SERVER);
print('hoge');