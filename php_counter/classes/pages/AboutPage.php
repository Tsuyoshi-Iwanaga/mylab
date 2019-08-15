<?php
require_once(dirname(__FILE__)."/../pages/_AbstractPage.php");

class AboutPage extends AbstractPage {

  protected function main() {
    $counter = new Counter();
    $this->data['counter_value'] = $counter->get();
  }
}
?>