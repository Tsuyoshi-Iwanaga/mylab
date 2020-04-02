<?php
ini_set('display_errors', 'On');

//Basic
class Sample01 {
  private $firstName;
  public $lastName;

  public function __counstruct($firstName, $lastName) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
  }

  public function getName() {
    return $this->firstName.'-'.$this->lastName;
  }
}