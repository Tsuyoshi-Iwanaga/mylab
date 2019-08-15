<?php

abstract class RequestVariables {

  protected $values = [];

  public function __construct() {
    $this->setValue();
  }

  abstract protected function setValue();

  //特定のキーからの値を取得
  public function get($key = null) {
    if($this->hasKey($key) === true) {
      return $this->values[$key];
    }
    return false;
  }

  //特定のキーが存在するか
  protected function hasKey($key) {
    if(array_key_exists($key, $this->values) === true) {
      return true;
    }
    return false;
  }
}

?>