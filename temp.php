<?php
ini_set('display_errors', 'On');

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

  public function display() {
    $this->displayHeader();
    $this->displayBody();
    $this->displayFooter();
  }
}

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

$data = ['aaa', 'bbb', 'ccc', 'ddd'];

$display1 = new ListDisplay($data);
$display2 = new TableDisplay($data);

$display1->display();
$display2->display();
