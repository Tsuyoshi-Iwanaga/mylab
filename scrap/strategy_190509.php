<?php

abstract class ReadItemDataStrategy {
  private $finename;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function getData() {
    if(!is_readable($this->getFilename())) {
      throw new Exception('file ['. $this->getFilename() .'] is not readable!');
    }
    return $this->readData($this->getFilename());
  }

  public function getFilename() {
    return $this->filename;
  }

  protected abstract function readData($filename);
}

class ReadFixedLengthDataStrategy extends ReadItemDataStrategy {
  protected function readData($filenamed) {
    $fp = fopen($filename, 'r');

    $dummy = fgets($fp, 4096);

    $return_value = array();
    while($buffer = fgets($fp, 4096)) {
      $item_name = trim(substr($buffer, 0, 20));
      $item_code = trim(substr($buffer, 20, 10));
      $price = (int)substr($buffer, 30, 8);
      $release_date = substr($buffer, 38);

      $obj = new stdClass();
      $obj->item_name = $item_name;
      $obj->item_code = $item_code;
      $obj->price = $price;

      $obj->release_date = mktime(0, 0, 0, substr($release_date, 4, 2), substr($release_date, 6, 2), substr($release_date, 0, 4));

      $return_value[] = $obj;
    }
    fclose($fp);
    return $return_value;
  }
}

class ReadTabSeparetedDataStrategy extends ReadItemDataStrategy {
  protected function readData($filename) {
    $fp = fopen($filename, 'r');

    $dummy = fgets($fp, 4096);

    $return_value = array();
    while($buffer = fgets($fp, 4096)) {
      list($item_code, $item_name, $price, $release_date) = split("\t", $buffer);

      $obj = new stdClass();
      $obj->item_name = $item_name;
      $obj->item_code = $item_code;
      $obj->price = $price;

      list($year, $mon, $day) = split('/', $release_date);
      $obj->release_data = mktime(0, 0, 0, $mon, $day, $year);

      $return_value[] = $obj;
    }
    fclose($fp);
    return $return_value;
  }
}

class ItemDataContext {
  private $strategy;

  public function __construct() {
    $this->strategy = $strategy;
  }

  public function getItemData() {
    return $this->strategy->getData();
  }
}

function dumpData($data) {
  echo '<dl>';
  foreach($data as $object) {
    echo '<dt>'. $object->item_name. '</dt>';
    echo '<dd>商品番号:'. $object->item_code. '</dd>';
    echo '<dd>\\' . number_format($object->price). '-</dd>';
    echo '<dd>'. date('Y/m/d', $object->release_date). '発売</dd>';
  }
  echo '</dl>';
}

$strategy1 = new ReadFileLengthDataStrategy('fixed_length_data.txt');
$context1 = new ItemDataContext($stratrgy1);
dumpData($context->getItemData());

echo '<hr>';

$strategy2 = new ReadTabSeparatedDataStrategy('tab_separated_data.txt');
$context2 = new ItemDataContext($strategy2);
dumpData($context2->getItemData());
