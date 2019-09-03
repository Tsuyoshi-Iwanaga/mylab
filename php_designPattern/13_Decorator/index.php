<?php
ini_set('display_errors', 'On');

//デコレータパターン
//機能の追加を継承でやると静的な拡張なので限界がある...
//動的に機能追加を行うためのパターン

interface Text {
  public function getText();
  public function setText($str);
}

//装飾される元となるComponent
class PlainText implements Text {
  private $textString = null;

  public function getText() {
    return $this->textString;
  }

  public function setText($str) {
    $this->textString = $str;
  }
}

//Decorator
abstract class TextDecorator implements Text {
  private $text;

  public function __construct(Text $target) {
    $this->text = $target;
  }

  public function getText() {
    return $this->text->getText();
  }

  public function setText($str) {
    return $this->text->setText($str);
  }
}

//CocreteDecorator01
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

//CocreteDecorator02
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
function decorate($text, array $decorate = []) {
  $text_object = new PlainText();
  $text_object->setText($text);

  foreach($decorate as $val) {
    switch($val) {
      case 'double':
        $text_object = new DoubleByteText($text_object);
        break;
      case 'upper':
        $text_object = new UpperCaseText($text_object);
        break;
    }
  }
  echo $text_object->getText().'<br>';
}

$text = 'Hello, Decorator Pattern !!';
decorate($text);
decorate($text, ['double']);
decorate($text, ['upper']);
decorate($text, ['double', 'upper']);