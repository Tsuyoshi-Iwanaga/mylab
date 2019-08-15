<?php
ini_set('display_errors', "On");

class Counter {

  private $counter = 0;
  const COUNT_FILE_NAME = './classes/data/count.dat';

  public function __construct() {
    $cnt = $this->readFile(self::COUNT_FILE_NAME);

    if(is_numeric($cnt) == true) {
      $this->counter = $cnt;
    }
  }

  public function increment() {
    $cnt = $this->get();
    $this->set(++$cnt);

    $this->writeFile(self::COUNT_FILE_NAME, $this->get());
  }

  public function get() {
    return $this->counter;
  }

  private function set($value) {
    $this->counter = $value;
  }

  //File I/O
  private function writeFile($fileName, $content) {
    $fp = fopen($fileName, 'w');
    fputs($fp, $content);
    fclose($fp);
  }

  private function readFile($fileName) {
    if(file_exists($fileName)) {
      $fp = fopen($fileName, 'r');
      $data = trim(fgets($fp));
      fclose($fp);
    }
    return $data;
  }
}
?>