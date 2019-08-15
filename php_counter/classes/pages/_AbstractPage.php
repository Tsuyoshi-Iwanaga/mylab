<?php
require_once(dirname(__FILE__)."/../model/Counter.php");

abstract class AbstractPage {

  //データ埋め込み用の配列
  protected $data = array();

  //ページ固有の処理
  abstract protected function main();

  //ページ共通の処理
  public function exec() {
    try {
      $counter = new Counter();
      $counter->increment();
      $this->main();
    } catch (Exception $e) {
      die('システムエラーが発生しました');
    }
  }

  //データ埋め込み用
  public function getData($key = null) {
    if ($key == null) {
      return $this->data;
    } else {
      return $this->data[$key];
    }
  }
}

?>