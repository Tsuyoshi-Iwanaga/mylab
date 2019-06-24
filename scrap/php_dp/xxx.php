<?php

ini_set('display_errors', "On");

abstract class AbstractDisplay {
  private $data;

  public function __construct($data) {
    if(!is_array($data)) {
      $data = array($data);
    }
    $this->data = $data;
  }

  public function getData() {
    return $this->data;
  }

  public function display() {
    $this->displayHeader();
    $this->displayBody();
    $this->displayFooter();
  }

  protected abstract function displayHeader();
  protected abstract function displayBody();
  protected abstract function displayFooter();
}

class ListDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '<dl>';
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

class TableDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '<table border="1">';
  }

  protected function displayBody() {
    foreach($this->getData() as $key => $value) {
      echo '<tr>';
      echo '<td>Item'. $key. '</td>';
      echo '<td>'. $value '</td>';
      echo '</tr>';
    }
  }
}

$data = ["design pattern", "gang of four", "Template Method", "Templatemeshod"];

$display1 = new ListDisplay($data);
$display2 = new TableDisplay($data);

$display1->display();
$display2->display();
