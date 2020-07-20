<?php
ini_set('display_errors', 'On');

abstract class ReadItemDataStrategy
{
  private $filename;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function getData() {
    if(!is_readable($this->getFilename())) {
      throw new \Exception('file is not readable!');
    }
    return $this->readData($this->getFilename());
  }

  public function getFilename() {
    return $this->filename;
  }

  abstract protected function readData($filename);
}

class ReadJSONDataStrategy extends ReadItemDataStrategy
{
  protected function readData($filename) {
    $data = json_decode(file_get_contents($filename));

    foreach($data as $line) {
      $obj = new stdClass();
      $obj->item_name = $line->item_name;
      $obj->item_id = $line->item_id;
      $obj->price = $line->price;
      $obj->release_date = new DateTime($line->release_date);

      $return_value[] = $obj;
    }
    return $return_value;
  }
}

class ReadTabSeparatedDataStrategy extends ReadItemDataStrategy
{
  protected function readData($filename) {
    $fp = fopen($filename, 'r');
    $dummy = fgets($fp, 4096);
    $return_value = array();

    while(($buffer = fgets($fp, 4096)) !== false) {
      $data = explode("\t", trim($buffer));

      if(count($data) !== 4) {
        continue;
      }

      list($item_id, $item_name, $price, $release_date) = $data;

      $obj = new \stdClass();
      $obj->item_name = $item_name;
      $obj->item_id = $item_id;
      $obj->price = $price;
      $obj->release_date = new DateTime($release_date);

      $return_value[] = $obj;
    }
    fclose($fp);
    return $return_value;
  }
}

class ItemDataContext
{
  private $strategy;

  public function __construct(ReadItemDataStrategy $strategy) {
    $this->strategy = $strategy;
  }

  public function getItemData() {
    return $this->strategy->getData();
  }
}

function dumpData($data)
{
  foreach($data as $object) {
    echo $object->item_name;
    echo $object->item_id;
    echo number_format($object->price);
    echo $object->release_date->format('Y/m/d');
  }
}

echo 'Tab';
$context = new ItemDataContext(new ReadTabSeparateDataStrategy(__DIR__.'item_data.txt'));
dumpData($context->getItemData());

echo 'JSON';
$context = new ItemDataContext(new ReadJSONDataStrategy(__DIR__.'item_data.json'));
dumpData($context->getItemData());