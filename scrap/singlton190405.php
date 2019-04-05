<?php

/* Singleton */
class SingletonSample {
  private $id;

  private static $instance;

  private function __construct() {
    $this->id = md5(date('r') . mt_rand());
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new SingletonSample();
      echo 'a SingletonSample instance was created!';
    }
    return self::$instance;
  }

  public function getID() {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException ('Clone is not allowed against'. get_class($this));
  }
}

/* client Code */
require_once 'SingletonSample.class.php';

$instance1 = SingletonSample::getInstance();
sleep(1);
$instance2 = SingletonSample::getInstance();

echo '<hr>';

echo 'instanceID:' . $instance1->getID() .'<br>';
echo ($instance1->getID() === $instance2->getID() ? true : false );

echo '<hr>';

$instance1_clone = clone $instance1;
