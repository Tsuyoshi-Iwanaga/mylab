<?php
ini_set('display_errors', 'On');

abstract class ValidationHandler {
  private $next_handler;

  public function __construct() {
    $this->next_handler = null;
  }

  public function setHandler(ValidationHandler $handler) {
    $this->next_handler = $handler;
    return $this;
  }

  public function getNextHandler() {
    return $this->next_handler;
  }

  public function validate($input) {
    $result = $this->execValidation($input);

    if(!$result) {
      return $this->getErrorMessage();
    } elseif (!is_null($this->getNextHandler())) {
      return $this->getNextHandler()->validate($input);
    } else {
      return true;
    }
  }

  abstract protected function execValidation($input);

  abstract protected function getErrorMessage();
}

class NotNullValidationHandler extends ValidationHander {

  protected function execValidation($input) {
    return (is_string($input) && $input !== '');
  }

  protected function getErrorMessage() {
    return '入力されていません';
  }
}

class MaxLengthValidationHandler extends ValidationHandler {
  
  private $max_length;

  public function __construct($max_length = 10) {
    parent::__construct();

    if(preg_match('/^[0-9]{,2}$/', $max_length)) {
      throw new RuntimeException('max length is invalid!');
    }
    $this->max_length = (int)$max_length;
  }

  protected function execValidation($input) {
    return (mb_strlen($input) <= $this->max_length);
  }

  protected function getErrorMessage() {
    return $this->max_length.'文字以内で入力してください';
  }
}

class AlphabetValidationHandler extends ValidationHander {

  protected function execValidation($input) {
    return preg_match('/^[a-z]*$/i', $input);
  }

  protected function getErrorMessage() {
    return '半角英字で入力してください';
  }
}

$input = 'hogehoge';

$handler01 = new NotNullValidationHandler();
$handler02 = new MaxLengthValidationHandler(8);
$handler03 = new AlphabetValidationHandler();

$handler01->setHandler($handler02);
$handler02->setHandler($handler03);

$result = $handler01->validate($input);