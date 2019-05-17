<?php

ini_set('display_errors', "On");

//すでにあるclass
class ShowFile {
  private $filename;

  public function __construct($filename) {
    if (!is_readable($filename)) {
      throw new Exception('file "'. $filename. '" is not readable!');
    }
    $this->filename = $filename;
  }

  public function ShowPlain() {
    echo '<pre>';
    echo htmlspecialchars(file_get_contents($this->filename), ENT_QUOTES);
    echo '</pre>';
  }

  public function showHighlight() {
    highlight_file($this->filename);
  }
}

//こんなinterfaceが...
//ハイライトはさせたいけど、プレインテキスト表示はさせない。
//既存クラスは一切手を入れずに再利用したいけど、提供するAPIだけ変更したい。
interface DisplaySourceFile {
  public function display();
}

//継承を使ったAdapter
class DisplaySourceFileImpl01 extends ShowFile implements DisplaySourceFile {

  public function __construct($filename) {
    parent::__construct($filename);
  }

  public function display() {
    parent::showHighlight();
  }
}

//委譲を使ったAdapter
class DisplaySourceFileImpl02 implements DisplaySourceFile {
  private $show_file;

  public function __construct($filename) {
    $this->show_file = new ShowFile($filename);
  }

  public function display() {
    $this->show_file->showHighlight();
  }
}

//clientCode
$show_file = new DisplaySourceFileImpl01('./singleton.php');
$show_file->display();
$show_file->ShowPlain();//継承なので親のメソッドは使える

echo '<hr>';

$show_file = new DisplaySourceFileImpl02('./singleton.php');
$show_file->display();
$show_file->ShowPlain();//委譲なので親のメソッドは使えない
