<?php

abstract class AbstractDisplay {
  private $data;

  protected function __construct($data) {
    if(!is_array($data)) {
      $data = array($data);
    }
    $this->data = $data;
  }

  public function display() {
    $this->displayHeader();
    $this->displayBody();
    $this->displayFooter();
  }

  public function getData() {
    return $this->data;
  }

  protected abstract function displayHeader();
  protected abstract function displayBody();
  protected abstract function displayFooter();
}

require_once 'AbstractDisplay.class.php';

class ListDisplay extends AbstractDisplay {
  protected function diplayHeader() {
    echo '<dl>';
  }
  protected function displayBody() {
    foreach($this->getData() as $key => $value) {
      echo '<dt>Item'. $key . '</dt>';
      echo '<dd>Item'. $value . '</dd>';
    }
  }
  protected function displayFooter() {
    echo '</dl>';
  }
}

require_once 'ListDisplay.class.php';
require_once 'TableDisplay.class.php';

$data = array('Design Pattern', 'Gang of Four', 'Template Method');

$display1 = new ListDisplay($data);
$display2 = new TableDisplay($data);

$display1->display();
$display2->display();
