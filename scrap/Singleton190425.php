<?php

class SingltonSample {
  private $id;

  private static $instance;

  private function __construct() {
    $this->id = md5(date('r') . mt_rand());
  }

  public static function getInstanse() {
    if(!isset(self::$instance)) {
      self::$instance = new SingletonSample();
      echo 'a Singleton Sample instanse was created!';
    }
    return self::$instance;
  }
  public function getID () {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException ('Clone is not allowed against'. get_class($this));
  }
}

$instance1 = SingletonSample::getInstance();
$instance2 = SingletonSample::getInstance();

echo $instance1->getID() === $instanse2->getID() ? ture : false;
