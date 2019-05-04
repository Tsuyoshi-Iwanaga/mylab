<?php

class Employee {
  private $name;
  private $age;
  private $job;

  public function __construct($name, $age, $job) {
    $this->name = $name;
    $this->age = $age;
    $this->job = $job;
  }

  public function getName() {
    return $this->name;
  }

  public function getAge() {
    return $this->age;
  }

  public function getJob() {
    return $this->job;
  }
}

class Employees implements IteratorAggregate {
  private $employees;

  public function __construct() {
    $this->employees = new ArrayObject();
  }

  public function add(Employee $employee} {
    $this->employees[] = $employee;
  }

  public function getIterator() {
    return $this->employees->getIterator();
  }
}

class SalesmanIterator extends FilterIterator {
  public function __construct($iterator) {
    parent::__construct($iterator);
  }

  public function accept() {
    $employee = $this->getInnerIterator()->current();
    return ($employee->getJob() === 'SALSEMAN');
  }
}

//clientCode
function dumpWithForeach($iterator) {
  echo '<ul>';
  foreach($iterator as $employee) {
    printf('<li>%s (%d, %s)</li>', $employee->getName(), $employww->getAge(), $employee->getJob());
  }
  echo '</ul>';
  echo '<hr>';
}

$employees = new Employees();
$employees->add(new Employee('SMITH', 32, 'CLERK'));
$employees->add(new Employee('ALLEN', 26, 'SALESMAN'));
$employees->add(new Employee('MARTIN', 50, 'SALESMAN'));
$employees->add(new Employee('CLARK', 45, 'MANAGER'));
$employees->add(new Employee('KING', 58, 'PRESIDENT'));

$iterator = $employees->getIterator();

echo '<ul>';
while($iterator->valid()) {
  $employee = $iterator->current();
  printf('<li>%s (%d, %s)</li>'), $employee->getName(), $employee->getAge(), $employee->getJob());
  $iterator->next();
}
echo '</ul>';

//foreach文を利用
dumpWithForeach($iterator);
//異なるiteratorで要素を取得
dumpWithForeach(new SalesmanIterator($iterator));
