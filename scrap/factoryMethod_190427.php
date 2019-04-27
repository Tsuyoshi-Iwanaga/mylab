<?php

//---------------Product---------------//

interface Reader {
  public function read();
  public function display();
}

//---------------ConcreteProduct---------------//

class CSVFileReader implements Reader {
  private $filename;

  private $handler;

  public function __construct($filename) {
    if(!is_readable($filename)) {
      throw new Exception('file' .$filename .'is not readable!');
    }
    $this->filename = $filename;
  }

  public function read() {
    $this->handler = fopen($this->filename, 'r');
  }

  public function display() {
    $colum = 0;
    $tmp = '';
    while ($data = fgetcsv ($this->handler, 1000, ",")) {
      $num = count ($data);
      for ($c = 0; $c < $num; $c++) {
          if ($c == 0) {
              if ($column != 0 && $data[$c] != $tmp) {
                  echo "</ul>";
              }
              if ($data[$c] != $tmp) {
                  echo "<b>" . $data[$c] . "</b>";
                  echo "<ul>";
                  $tmp = $data[$c];
              }
          }else {
              echo "<li>";
              echo $data[$c];
              echo "</li>";
          }
      }
      $column++;
  }
  echo "</ul>";
  fclose ($this->handler);
  }
}

class XMLFileReader implements Reader {
  private $filename;

  private $handler;

  public function __construct($filename) {
    if (!is_readable($filename)) {
      throw new Exception('file'. $filename. 'is not readable!');
    }
    $this->filename = $filename;
  }

  public function read() {
    $this->handler = simplexml_load_file($this->filename);
  }

  public function convert($str) {
    return mb_convert_encoding($str, mb_internal_encoding(), 'auto');
  }

  public function display() {
    foreach($this->handler->artist as $artist) {
      echo '<b>' . $this->convert($artist['name']). '</b>';
      echo '<ul>';
      foreach($artist->music as $music) {
        echo '<li>';
        echo $this->convert($music['name']);
        echo '</li>';
      }
      echo '</ul>';
    }
  }
}

//---------------Creator---------------//

class ReaderFactory {

  //factoryMethod
  public function create($filename) {
    $reader = $this->createReader($filename);
    return $reader;
  }

  private function createReader($filename) {
    $poscsv = stripos($filename, '.csv');
    $posxml = stripos($filename, '.xml');

    if($poscsv !== false) {
      return new CSVFileReader($filename);
    } elseif ($posxml !== false) {
      return new XMLFileReader($filename);
    } else {
      die('This filename is not supported!');
    }
  }
}

//---------------client---------------//

$filename = 'Music.xml';
$factory = new ReaderFactory();
$data = $factory->create($filename);
$data->read();
$data->display();
