<?php
require_once(dirname(__FILE__).'/RequestVariables.php');

class Post extends RequestVariables {

  protected function setValue() {
    foreach ($_POST as $key => $value) {
      $this->value[$key] = $value;
    }
  }
}
?>