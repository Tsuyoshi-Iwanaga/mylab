<?php
ini_set('display_errors', 'On');

//★ファクトリメソッドパターン
//オブジェクトの生成側と利用側のコードを分離する。
//利用側にnew Hoge();と書かずFactory経由でインスタンスを生成するため修正の時はFactoryを直すだけなので見通しがよくなる

interface Reader {
  public function read();
  public function display();
}

class TextFileReader implements Reader {

  private $filename;

  public function __construct($filename) {
    if(!is_readable($filename)) {
      throw new Exception("$filename is not readable!");
    }
    $this->filename = $filename;
  }

  public function read() {
    $this->handler = fopen($this->filename, 'r');
  }

  public function display() {
    $prev_artist = null;
    $titles = [];

    while(($buffer = fgets($this->handler, 4096)) !== false) {
      $data = explode("\t", trim($buffer));
      if(count($data) !== 2) {
        continue;
      }
      list($artist, $title) = $data;
      if($prev_artist === null) {
        $prev_artist = $artist;
      }
      if($artist !== $prev_artist) {
        $this->displayDetail($prev_artist, $titles);

        $prev_artist = $artist;
        $titles = [];
      }
      $titles[] = $title;
    }

    if(count($titles) > 0) {
      $this->displayDetail($prev_artist, $titles);
    }
  }

  private function displayDetail($artist, array $titles = []) {
    printf('%s<br>', $artist);
    printf('-->%s<br>', implode('-->', $titles));
  }
}

class XMLFileReader implements Reader {

  private $filename;
  private $handler;

  public function __construct($filename) {
    if(!is_readable($filename)) {
      throw new Exception("$filename is not readable!");
    }
    $this->filename = $filename;
  }

  public function read() {
    $this->handler = simplexml_load_file($this->filename);
  }

  public function display() {
    foreach($this->handler->artist as $artist) {
      printf('%s<br>', $artist['name']);
      foreach($artist->music as $music) {
        printf('-->%s<br>', $music['name']);
      }
    }
  }
}

//Factory(Singletonを併用)
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
      die("This filename is not supported: $filename");
    }
  }
}

//clientCode
function show ($filename) {
  $factory = ReaderFactory::getInstance();
  $data = $factory->createReader($filename);
  $data->read();
  $data->display();
}

show(__DIR__.'/src/music.txt');
echo('<hr>');
show(__DIR__.'/src/music.xml');
