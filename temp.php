<?php
ini_set('display_errors', 'On');

class Sigleton {
  private $id;
  private static $instance;

  private function __construct() {
    $this->id = md5(date('r').mt_rand());
  }

  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new Singleton();
    }
    return self::$instance;
  }

  public function getId() {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against'. get_class($this));
  }
}

$instance01 = Singleton::getInstance();
$instance02 = Singleton::getInstance();
echo '<hr>';

echo $instance01->getId(). '<br>';
echo $instance02->getId(). '<br>';