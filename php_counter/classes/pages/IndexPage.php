<?php
require_once(dirname(__FILE__)."/../pages/_AbstractPage.php");

class IndexPage extends AbstractPage {

  protected function main() {
    $this->data['counter_value'] = $this->counter->get();
  }
}
?>