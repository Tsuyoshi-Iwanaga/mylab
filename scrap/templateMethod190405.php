<?php

/* AbstractClass */
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

/* Concrete Class01 */
require_once 'AbstractDisplay.class.php';

class ListDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '<dl>';
  }
  protected function displayBody() {
    foreach ( $this->getData() as $key => $value ) {
      echo '<dt>Item:'. $key . '</dt>';
      echo '<dd>' . $value . '</dd>';
    }
  }
  protected function displayFooter() {
    echo '</dl>';
  }
}

/* Concrete Class02 */
require_once 'AbstractDisplay.class.php';

class TableDisplay extends AbstractDisplay {
  protected function displayHeader() {
    echo '<table border="1" cellpadding="2" cellspacing="2">';
  }
  protected function displayBody() {
    foreach( $this->getData() as $key => $value ) {
      echo '<tr>';
      echo '<th>'. $key . '</th>'
      echo '<td>' . $value . '<td>';
      echo '</tr>'
    }
  }
  protected function displayFooter() {
    echo '</table>';
  }
}

/* CliantCode */
require_once 'ListDisplay.class.php';
require_once 'TableDisplay.class.php';

$data = array('Design Pattern', 'Gang of Four', 'Template Method Sample1');

$display1 = new ListDisplay($data);
$display2 = new TableDisplay($data);

$display1->display();
echo '<hr>';
$display2->display();
