<?php

//singleton
class SingletonSample {

  private $id;

  private static $instance;

  private function __construct() {
    $this->id = md5(date('r'). mt_rand());
  }

  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new SingletonSample();
      echo 'a SingletonSample instance was created!';
    }
    return self::$instance;
  }

  public function getID() {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against' . get_class($this));
  }
}

//client
$instance1 = SingletonSample::getInstance();
$instance2 = SingletonSample::getInstance();

echo 'ID is same?:' . ($instance1->getID() === $instance2->getID() ? 'true' : 'false');//true

echo 'instance is same?:' . ($instance1 === $instance2 ? 'true' : 'false');//true

$instance1_clone = clone $instance1;//Fatal error
