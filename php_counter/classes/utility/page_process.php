<?php
require_once(dirname(__FILE__)."/loader.php");
try {
  $instance = Loader::getPageInstance();
  $instance->exec();
  $data = $instance->getData();
} catch (Exception $e) {
  die($e->getMessage());
}
?>