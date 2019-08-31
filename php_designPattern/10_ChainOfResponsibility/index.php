<?php
ini_set('display_errors', 'On');

//チェインオブレスポンシビリティ
//1つのクラスには1つしか責任を持たせない
//自分で処理できないものは別のオブジェクトに処理をさせる
//ifやswitchのように1箇所に条件と判定後処理がまとまらないので見やすくなる

//Handler
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

    echo($input.':'.$result.'<br>');
    var_dump($this->getNextHandler());
    echo('<hr>');

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

//ConcreteHandler01
class NotNullValidationHandler extends ValidationHandler {
  
  protected function execValidation($input) {
    return (is_string($input) && $input !== '');
  }

  protected function getErrorMessage() {
    return '入力されていません';
  }
}

//ConcreteHandler02
class MaxLengthValidationHandler extends ValidationHandler {

  private $max_length;

  public function __construct($max_length = 10) {
    parent::__construct();

    if (preg_match('/^[0-9]{,2}$/', $max_length)) {
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

//ConcreteHandler03
class AlphabetValidationHandler extends ValidationHandler {
  
  protected function execValidation($input) {
    return preg_match('/^[a-z]*$/i', $input);
  }

  protected function getErrorMessage() {
    return '半角英字で入力してください';
  }
}

//clientCode
$input = 'hogehoge';

$handler01 = new NotNullValidationHandler();
$handler02 = new MaxLengthValidationHandler(8);
$handler03 = new AlphabetValidationHandler();

$handler01->setHandler($handler02);
$handler02->setHandler($handler03);

$result = $handler01->validate($input);

echo ($result === true ? 'OK' : $result);
?>