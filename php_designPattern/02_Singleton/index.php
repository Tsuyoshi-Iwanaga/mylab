<?php
ini_set('display_errors', 'On');

//シングルトン
//インスタンスが1つしか作れないことを保証したい時に使う
//クラス内部に唯一のインスタンスを格納するクラスメンバを作る
//コンストラクタをprivateにして、インスタンスを返すクラスメソッドを別途用意する

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
    return self::$instance;
  }

  public function getId() {
    return $this->id;
  }

  //インスタンスの複製を許可しない
  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against '. get_class($this));
  }
}

//クライアントコード
$instance01 = Singleton::getInstance();
$instance02 = Singleton::getInstance();
echo '<hr>';

//同一のインスタンスを参照しているか確認
echo $instance01->getId().'<br>';
echo $instance02->getId().'<br>';

//newでインスタンスを生成しようとするとエラー
// $instance03 = new Singleton();

//cloneしようとするとエラー
// $instance04 = clone $instance01;
?>