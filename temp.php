<?php
ini_set('display_errors', 'On');

interface Reader {
  public function read();
  public function display();
}

class TextFileReader implements Reader {
  private $filename;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function read() {}

  public function display() {}

  private function displayDetail() {
  }
}

class XMLFileReader implements Reader {
  private $filename;
  private $handler;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function read() {}

  public function display() {}
}

class ReaderFactory {
  private static $instance;

  private function __construct() {}

  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new ReaderFactory();
    }
    return self::$instance;
  }

  public function createReader($filename) {
    $postxt = stripos($filename, '.txt');
    $posxml = stripos($filename, '.xml');

    if($postxt !== false) {
      return new TextFileReader($filename);
    } elseif($posxml !== false) {
      return new XMLFileReader($filename);
    } else {
      die("This filename is not supported: $filename")
    }
  }
}

$filename = __DIR__.'/src/music.txt';
$factory = ReaderFactory::getInstance();
$reader = $factory->createReader($filename);
$reader->read();
$reader->display();