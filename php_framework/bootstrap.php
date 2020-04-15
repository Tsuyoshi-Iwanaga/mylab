<?php
//アプリケーション実行前の前処理

require_once 'core/ClassLoader.php';

$loader = new ClassLoader();
$loader->registerDir(dirname(__FILE__).'models');
$loader->registerDir(dirname(__FILE__).'models');
$loader->register();