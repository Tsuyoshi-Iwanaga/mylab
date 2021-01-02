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
    $this->displayHeaer();
    $this->displayBody();
    $this->displayFooter();
  }
}

class ListDisplay extends AbstarctDisplay {
  protected function displayHeader() {
    echo '</dl>';
  }

  protected function displayBody() {
    foreach($this->getData() as $key => $value) {
      echo '<dt>Item'. $key. '</dt>';
      echo '<dd>'. $key. '</dd>';
    }
  }

  protected function displayFooter() {
    echo '</dl>';
  }
}

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

$data = ['Design Pattern', 'Gang of four', 'Template Method1', 'TemplateMethod2'];

$display1 = new ListDisplay($data);
$display2 = new TableDisplay($data);

$display1->display();
echo '<tr>';
$display2->display();
?>