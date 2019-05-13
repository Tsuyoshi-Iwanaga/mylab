<?php

abstract class AbstractDisplay {
  private $data;

  public function __construct($data) {
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

class ListDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '<dl>';
  }

  protected function displayBody() {
    foreach($this->getData() as $key => $value) {
      echo '<dt>Item'. $key . '</dt>';
      echo '<dd>'. $value . '</dd>';
    }
  }

  protected function displayFooter() {
    echo '</dt>';
  }
}

class TableDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '<table>';
  }

  protected function displayBody() {
    foreach($this->getData() as $key => $value) {
      echo '<tr>';
      echo '<th>'. $key. '</th>';
      echo '<td>'. $value. '</td>';
      echo '</tr>';
    }
  }

  protected function displayFooter() {
    echo '</table>';
  }
}

//clientCode
$data = ['Design Pattern', 'Gang of four', 'Template Method'];

$display1 = new ListDisplay($data);
$display2 = new TableDisplay($data);

$display1->display();
$display2->display();
