<?php

  abstract class AbstractDisplay {
    private $data;

    public function __construct() {
      if(!is_array($data)) {
        $data = array($data);
      }
      $this->data = $data;
    }

    public function getData() {
      return $data;
    }

    protected function displayHeader();
    protected function displayBody();
    protected function displayFooter();
  }

  class ListDisplay extends AbstructDisplay {
    protected function displayHeader() {
      echo '<dl>';
    }

    protected function displayBody() {
      foreach($this->getData() as $key => $value) {
        echo '<dt>Item' . $key . "</dt>";
        echo '<dd>'. $value . '</dd>';
      }
    }

    protected function displayFooter() {
      echo '</dl>';
    }
  }

  class TableDisplay extends AbstructDisplay {
    protected function displayHeader() {
      echo '<table>';
    }
    protected function displayBody() {
      foreach($this->getData() as $key => $value) {
        echo '<tr>';
        echo '<th>' . $key . '</th>';
        echo '<td>' . $value . '</td>';
        echo '</tr>';
      }
    }
    protected function displayFooter() {
      echo '</table>';
    }
  }

  $data = array('Desing Pattern', 'Gang of four');

  $display01 = new ListDisplay($data);
  $display02 = new ListTable($data);

  $display01->display();
  $display02->display();
