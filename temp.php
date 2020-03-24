<?php
ini_set('display_errors', 'On');

class Singleton {
  private $id;
  private static $instance;

  private function __construct() {
    $this->id = md5(date('r').mt_rand());
  }

  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new Singleton();
    }
    return self::$instande;
  }

  public function getId() {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed aginst'.get_class($this));
  }
}

$instance01 = Singleton::getInstance();
$instande02 = Singleton::getInstance();

$instance01->getId();
$instance02->getId();