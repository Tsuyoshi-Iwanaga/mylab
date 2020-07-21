<?php
ini_set('display_errors', 'On');

abstract class OrganizationEntry {
  private $code;
  private $name;

  public function __construct($code, $name) {
    $this->code = $code;
    $this->name = $name;
  }

  public function getCode() {
    return $this->code;
  }

  public function getName() {
    return $this->name;
  }

  abstract public function add(OrganizationEntry $entry);

  public function dump() {
    printf('%s:%s<br>', $this->code, $this->name);
  }
}

class Group extends OrganizationEntry {
  private $entries;

  public function __construct($code, $name) {
    parent::__construct($code, $name);
    $this->entries = array();
  }

  public function add(OrganizationEntry $entry) {
    array_push($this->entries, $entries);
  }

  public function dump() {
    parent::dump();
    foreach($this->entries as $entry) {
      $entry->dump();
    }
  }
}

<<<<<<< HEAD
class Employee extents OrganizationEntry {
  public function __construct($code, $name) {
    parent::__construct($code, $name);
  }

  public function add(OrganizationEntry $entry) {
    throw new Exception('method not allowed');
  }
}

$root_entry = new Group('001', '本社');
$root_entry->add(new Emploee("00101", "CEO"));
$root_entry->add(new Emploee("00102", "CTO"));

$group1 = new Group("010", "〇〇支店");
$group1->add(new Employee("01001", "支店長"));
$group1->add(new Employee("01002", "佐々木"));
$group1->add(new Employee("01003", "鈴木"));
$group1->add(new Employee("01003", "吉田"));

$group2 = new Group("110", "▲▲営業所");
$group2->add(new Employee("11001", "川村"));

$group1->add($group2);
$root_entry->add($group1);

$group3 = new Group("020", "××支店");
$group3->add(new Employee("02001", "荻原"));
$group3->add(new Employee("02002", "田島"));
$group3->add(new Employee("02002", "白井"));
$root_entry->add($group3);

$root_entry->dump();
=======
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
>>>>>>> 6b53fdd2e74a580608b1ad804f763c959c9e34ed
