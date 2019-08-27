<?php

ini_set('display_errors', "On");

interface Reader {
  public function read();
  public function display();
}

class CSVFileReader implements Reader {

  private $filename;

  private $handler;

  public function __construct($filename) {
    if(!is_readable($filename)) {
      throw new Exception('file'. $filename. 'is not readable!');
    }
    $this->filename = $filename;
  }

  public function read() {
    $this->handler = fopen($this->filename, 'r');
  }

  public function display() {
    $column = 0;
    $tmp = '';

    while ($data = fgetcsv($this->handler, 1000, ',')) {
      $num = count($data);
      for ($c = 0; $c < $num; $c++) {
        if($c == 0) {
          if($column != 0 && $data[$c] != $tmp) {
            echo '</ul>';
          }
          if($data[$c] != $tmp) {
            echo '<b>'. $data[$c]. '</b>';
            echo '<ul>';
            $tmp = $data[$c];
          }
        } else {
          echo '<li>';
          echo $data[$c];
          echo '</li>';
        }
      }
      $column++;
    }
    echo '</ul>';
    fclose($this->handler);
  }
}

class XMLFileReader implements Reader {

  private $filename;

  private $handler;

  public function __construct($filename) {
    if (!is_readable($filename)) {
      throw new \Exception('file '.$filename.' is not readable !');
    }
    $this->filename = $filename;
  }

  public function read() {
    $this->handler = simplexml_load_file($this->filename);
  }

  public function display() {
    foreach($this->handler->artist as $artist) {
      echo '<b>'. $artist['name']. '</b>';
      echo '<ul>';
      foreach($artist->music as $music) {
        echo '<li>';
        echo $music['name'];
        echo '</li>';
      }
      echo '</ul>';
    }
  }
}

//factory
class ReaderFactory {

  public function create($filename) {
    $reader = $this->createReader($filename);
    return $reader;
  }

  //条件に応じてインスタンスを返すFactoryMethod
  private function createReader($filename) {
    $poscsv = stripos($filename, '.csv');
    $posxml = stripos($filename, '.xml');

    if ($poscsv !== false) {
      return new CSVFileReader($filename);
    } elseif ($posxml !== false) {
      return new XMLFileReader($filename);
    } else {
      die('This filename is not supported:'. $filename);
    }
  }
}

//clientCode
//$filename = './src/sample01.csv';
$filename = './src/sample01.xml';

$factory = new ReaderFactory();
$data = $factory->create($filename);
$data->read();
$data->display();

?>
<html lnag="ja">
<head>
<title>作曲者と作品たち</title>
</head>
<body>
</body>
</html>
