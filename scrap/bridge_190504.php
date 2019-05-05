<?php

interface DataSource {
  public function open();
  public function read();
  public function close();
}

class FileDataSource implements DataSource {
  private $source_name;
  private $handler;

  function __construct($source_name) {
    $this->source_name = $source_name;
  }

  function open() {
    if(!is_readable($this->source_name)) {
      throw new Exception('データソースがみつかりません');
    }
    $this->handler = fopen($this->source_name, 'r');
    if(!$this->handler) {
      throw new Exception('データソースのオープンに失敗しました');
    }
  }

  function read() {
    $buffer = array();
    while(!feof($this->handler)) {
      $buffer[] = fgets($this->handler);
    }
    return join($buffer);
  }

  function close() {
    if(!is_null($this->handler)) {
      fclose($this->handler);
    }
  }
}

class Listing {
  private $data_source;

  function __construct($data_source) {
    $this->data_source->open();
  }

  function read() {
    return $this->data_source->read();
  }

  function close() {
    $this->data_source->close();
  }
}

class ExtendedListing extends Listing {
  function __construct($data_source) {
    parent::__construct($data_source);
  }

  function readWithEncode() {
    return htmlspecialchars($this->read(), ENT_QUOTES, mb_convert_encoding());
  }
}

//clientCode
$list1 = new Listing(new FileDataSource('data.txt'));
$list2 = new ExtendedListing(new FileDataSource('data.txt'));

try {
  $list1->open();
  $list2->open();
} catch (Exception $e) {
  die($e->getMessage());
}

$data = $list1->read();
echo $data;

$data = $list2->readWithEncode();
echo $data;

$list1->close();
$list2->close();
