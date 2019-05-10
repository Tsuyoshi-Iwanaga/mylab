<?php

interface Text {
  public function getText();
  public function setText($str);
}

class PlainText implements Text {
  private $textString = null;

  public function getText() {
    return $this->textString;
  }

  public function setText($str) {
    $this->textString = $str;
  }
}

abstract class TextDecorator implements Text {
  private $text;

  public function __construct(Text $target) {
    $this->text = $target;
  }

  public function getText() {
    return $this->text->getText();
  }

  public function setText($str) {
    $this->text->setText($str);
  }
}

class UpperCaseText extends TextDecorator {
  public function __construct(Text $target) {
    parent::__construct($target);
  }

  public function getText() {
    $str = parent::getText();
    $str = mb_strtoupper($str);
    return $str;
  }
}

class DoubleByteText extends TextDecorator {
  public function __construct(Text $target) {
    parent::__construct($target);
  }

  public function getText() {
    $str = parent::getText();
    $str = mb_convert_kana($str, "RANSKV");
    return $str;
  }
}

//clientCode
$text = (isset($_POST['text']) ? $_POST['text'] : '');
$decorate = (isset($_POST['decorate']) ? $_POST['decorate'] : array());

if($text !== '') {
  $text_object = new PlainText();
  $text_object->setText($text);

  foreach($decorate as $val) {
    switch ($val) {
      case 'double':
        $text_object = new DoubleByteText($text_object);
        break;
      case 'upper':
        $text_object = new UpperCaseText($text_object);
        break;
      default:
        throw new RuntimeException('invalid decorator');
    }
  }
  echo htmlspecialchars($text_object->getText(), ENT_QUOTES, mb_internal_encoding()) . "<br>";
}
?>
<hr>
<form action="" method="post">
テキスト：<input type="text" name="text"><br>
装飾：<input type="chekbox" name="decorate[]" value="upper">大文字に変換
<input type="checkbox" name="decorate[]" value="double">2バイト文字に変換
<input type="submit">
</form>
