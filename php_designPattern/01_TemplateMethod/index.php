<?php
ini_set('display_errors', 'On');

//★テンプレートメソッドパターン
//親クラス(抽象クラス)ではインスタンスから利用できるAPIや共通の処理を規定する
//子クラスでは親クラスのAPIの具体的な中身(抽象メソッド)を実装する
//使うときは子クラスでnewしてインスタンス生成し、親クラスに用意されたAPIのみを使う

//AbstractClass
abstract class AbstractDisplay {
  private $data;

  public function __construct($data) {
    if(!is_array($data)) {
      $data = array($data);
    }
    $this->data = $data;
  }

  protected function getData() {
    return $this->data;
  }

  protected abstract function displayHeader();
  protected abstract function displayBody();
  protected abstract function displayFooter();

  //API
  public function display() {
    $this->displayHeader();
    $this->displayBody();
    $this->displayFooter();
  }
}

//ConcreteClass01
class ListDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '</dl>';
  }

  protected function displayBody() {
    foreach($this->getData() as $key => $value) {
      echo '<dt>Item'. $key. '</dt>';
      echo '<dd>'. $value. '</dd>';
    }
  }

  protected function displayFooter() {
    echo '</dl>';
  }
}

//ConcreteClass02
class TableDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '<table>';
  }

  protected function displayBody() {
    foreach($this->getData() as $key => $value) {
      echo '<tr>';
      echo '<td>Item'. $key. $value. '</td>';
      echo '<td>'. $value. '</td>';
      echo '</tr>';
    }
  }

  protected function displayFooter() {
    echo '</table>';
  }
}

//clientCode
$data = ['Design Pattern', 'Gang of four', 'Template Method1', 'TemplateMethod2'];

$display1 = new ListDisplay($data);
$display2 = new TableDisplay($data);

$display1->display();
echo '<hr>';
$display2->display();
?>