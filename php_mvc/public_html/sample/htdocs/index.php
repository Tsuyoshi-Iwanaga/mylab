<?php
ini_set('display_errors', "On");

require_once(dirname(__FILE__).'/../../../library/mvc/Dispatch.php');

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot(dirname(__FILE__).'/../');
$dispatcher->dispatch();
?>