<?php

abstract class OrgenizationEntry {
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

  public abstract function add(OrganizationEntry $entry);

  public abstract function getChildren();

  public abstract function accept(Visitor $visitor) {
    $visitor->visitor($this)
  }
}

class Group extends OrgenizationEntry {
  private $entries;

  public function __construct($code, $name) {
    parent::__construct($code, $name);
    $this->entries = array();
  }

  public function add(OrganizationEntry $entry) {
    array_push($this->entries, $entry);
  }

  public function getChildren() {
    return $this->entries;
  }
}

class Employee extends OrganizationEntry {
  public function __construct($code, $name) {
    parent::__construct($code, $name);
  }

  public function add(OrganizationEntry $entry) {
    throw new Exception('method not allowed');
  }

  public function getChildren() {
    return array();
  }
}

interface Visitor {
  public function visit(Organization $entry);
}

class DumpVisitor implements Visitor {
  public function visit(OrganizationEntry $entry) {
    if(get_class($entry) === 'Group') {
      echo '■';
    } else {
      echo '&nbsp;&nbsp;';
    }
    echo $entry->getCode() . ':' . $entry->getName() . "<br>\n";

    foreach ($entry->getChildren() as $ent) {
      $ent->accept($this);
    }
  }
}

class CountVisitor implements Visitor {
  private $group_count = 0;
  private $employee_count = 0;

  public function visit(Organization $entry) {
    if(get_class($entry) === 'Group') {
      $this->group_count++;
    } else {
      $this->employee_count++;
    }
    foreach($entry->getChildren() as $ent) {
      $this->visit($ent);
    }
  }

  public function getGroupCount() {
    return $this->group_count;
  }

  public function getEmployeeCount() {
    return $this->employee_count;
  }
}

//clientCode
$root_entry = new Group("001", "本社");
$root_entry->add(new Employee("00101", "CEO"));
$root_entry->add(new Employee("00102", "CTO"));

$group1 = new Group("010", "○○支店");
$group1->add(new Employee("01001", "支店長"));
$group1->add(new Employee("01002", "佐々木"));
$group1->add(new Employee("01003", "鈴木"));
$group1->add(new Employee("01003", "吉田"));

$group2 = new Group("110", "△△営業所");
$group2->add(new Employee("11001", "川村"));
$group1->add($group2);
$root_entry->add($group1);

$group3 = new Group("020", "××支店");
$group3->add(new Employee("02001", "萩原"));
$group3->add(new Employee("02002", "田島"));
$group3->add(new Employee("02002", "白井"));
$root_entry->add($group3);

$root_entry->accept(new DumpVisitor());

$visitor = new CountVisitor();
$root_entry->accept($visitor);
echo '組織数:' . $visitor->getGroupCount(). '<br>';
echo '社員数:' . $visitor->getEmployeeCount(). '<br>';
