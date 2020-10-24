<?php
ini_set('display_errors', 'On');

//Compositパターン 再帰的な木構造を作る

//共通に持つAPI定義
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

//複合(Composite)のクラス
class Group extends OrganizationEntry {
  private $entries;

  public function __construct($code, $name) {
    parent::__construct($code, $name);
    $this->entries = array();
  }

  public function add(OrganizationEntry $entry) {
    array_push($this->entries, $entry);
  }

  public function dump() {
    parent::dump();
    foreach($this->entries as $entry) {
      $entry->dump();
    }
  }
}

//末端(Leaf)のクラス
//末端なのでaddメソッドは実装しない
class Employee extends OrganizationEntry {

  public function __construct($code, $name) {
    parent::__construct($code, $name);
  }

  public function add(OrganizationEntry $entry) {
    throw new Exception('method not allowed');
  }
}

//clientCode
$root_entry = new Group('001', '本社');
$root_entry->add(new Employee("00101", "CEO"));
$root_entry->add(new Employee("00102", "CTO"));

$group1 = new Group("010", "○○支店");
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
