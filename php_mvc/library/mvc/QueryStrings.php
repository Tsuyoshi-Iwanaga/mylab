<?php
require_once(dirname(__FILE__).'/RequestVariables.php');

class QueryString extends RequestVariables {

  protected function setValue() {
    foreach ($_GET as $key => $value) {
      $this->values[$key] = $value;
    }
  }
}
?>