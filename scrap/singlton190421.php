<?php

class SingletonSample {
  private $id;

  private static $instanse;

  private function __construct() {
    $this->id = md5(date('r') . mt_rand());
  }

  public static function getInstanse() {
    if(!isset(self::$instanse)) {
      self::$instanse = new SingletonSample();
      echo 'a Singleton Sample instanse was created!';
    }
    return self::$instanse;
  }

  public function getID () {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException ('Clone is not allowed against' . get_class($this));
  }
}

$instanse1 = SingletonSample::getInstense();
$instanse2 = SingletonSample::getInstanse();

echo $instanse1->getID() === $instanse2->getID() ? true : false;
