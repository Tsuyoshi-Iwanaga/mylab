<?php

class Singleton {
  private $id;
  private static $instance;

  private function __construct() {
    $this->id = md5(data('r').mt_rand());
  }

  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new SingletonSample();
      echo 'a SingletonSample instance was created';
    }
    return self::$instance;
  }

  public function getId() {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against'. get_clone($this));
  }
}

//clientCode
$instance1 = SingletonSample::getInstance();
$instance2 = SingletonSample::getInstance();

echo 'ID is same?:'. ($instance1->getId() === $instance2->getId() ? true : false);
echo 'instance is same?:'. ($instance1 === $instance2 ? true : false);

$instance1_clone = clone $instance1;//Fatal error
