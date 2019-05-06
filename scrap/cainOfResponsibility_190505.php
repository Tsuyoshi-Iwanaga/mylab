<?php
class AlpabetValidationHeader extends ValidationHandler {
  protected function execValidation($input) {
    return preg_match('/^[a-z]*$/i', $input);
  }

  protected function getErrorMessage() {
    return '半角英字で入力してください';
  }
}

class NumberValidationHandler extends ValidationHandler {
  protected function execValidation($input) {
    return (preg_match('/^[0-9]*$/', $input) > 0);
  }

  protected function getErrorMessage() {
    return '半角数字で入力してください';
  }
}

class NotNullValidationHandler extends ValidationHandler {
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
      throw new RuntimeException('max length is invalid (0-99)!');
    }
    $this->max_length = (int)$max_length;
  }

  public function execValidation($input) {
    return (strlen($input) <= $this->max_length);
  }

  protected function getErrorMessage() {
    return $this->max_length . 'バイト以内で入力してください';
  }
}

if(isset($_POST['validation_type']) && isset($_POST['input'])) {
  $validation_tyle = $_POST['validate_type'];
  $input = $_POST['input'];

  $not_null_handler = new NotNullValidationHandler();
  $length_handler = new MaxLengthValidationHandler(8);

  $option_handler = null;
  switch($validate_type) {
    case 1:
      include_once 'AlphabetValidationHandler.class.php';
      $option_handler = new AlphabetValidationHandler();
      break;
    case 2:
      include_once 'NumberValidationHandler.class.php';
      $option_handler = new NumberValidationHandler();
      break;
  }

  if(!is_null($option_handler)) {
    $length_handler->setHandler($option_handler);
  }
  $handler = $not_null_handler->setHandler($length_handler);

  $result = $handler->validate($_POST['input']);
  if($result === false) {
    echo '検証できませんでした';
  } elseif(is_string($result) && $result !== ''){
    echo '<p style="color: #dd0000;">'. $result .'</p>';
  } else {
    echo '<p style="color: #008800;">OK</p>';
  }
}
?>
<form action="" method="post">
  <div>
    値：<input type="text" name="input">
  </div>
  <div>
    検証内容：<select name="validate_type">
    <option value="0">任意</option>
    <option value="1">半角英字で入力されているか</option>
    <option value="2">半角数字で入力されているか</option>
    </select>
  </div>
  <div>
    <input type="submit">
  </div>
</form>
