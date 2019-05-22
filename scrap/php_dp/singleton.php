<?php

ini_set('display_errors', "On");

class Singleton {
  private $id;

  private static $instance;

  //コンストラクタをprivateにする → newできなくなる
  private function __construct() {
    $this->id = md5(date('r'). mt_rand());
  }

  //Singletonインスタンスを返すメソッド
  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new Singleton();
      echo "<p>Instance has been created!</p>";
    }
    return self::$instance;
  }

  public function getId() {
    return $this->id;
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed '. get_class($this));
  }
}

//インスタンスの生成
//$instance1 = new Singleton(); これはエラーになる
$instance1 = Singleton::getInstance();
$instance2 = Singleton::getInstance();
echo '<hr>';

//2つのインスタンスは同一のID?
echo '$instande1->getId():'. $instance1->getId(). '<br>';
echo '$instance1.getId() === $instance2.getId(): '. ($instance1->getId() === $instance2->getId() ? 'true' : 'false');
echo '<hr>';

//2つのインスタンスは同一?
echo '$instance1 === $instance2: '. ($instance1 === $instance2 ? 'true' : 'false');
echo '<hr>';

//cloneしようとするとエラー
$instane3 = clone $instance1;
