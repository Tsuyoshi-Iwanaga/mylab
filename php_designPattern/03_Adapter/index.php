<?php
ini_set('display_errors', 'On');

//アダプターパターン

//もともと存在したクラス
//showHighlight()を使いたいけど別のメソッド名(display)で呼び出したい
class ShowFile {
  private $filename;

  public function __construct($filename) {
    if(!is_readable($filename)) {
      throw new Exception("${filename} is not readable!");
    }
    $this->filename = $filename;
  }

  public function showPlain() {
    echo file_get_contents($this->filename);
  }

  public function showHighlight() {
    highlight_file($this->filename);
  }
}

interface DisplaySourceFile {
  public function display();
}

//インスタンスを内部に格納し、メソッドを呼び出す
class DisplaySourceFileImpl implements DisplaySourceFile {
  private $show_file;

  public function __construct($filename) {
    $this->show_file = new ShowFile($filename);
  }

  public function display() {
    $this->show_file->showHighlight();
  }
}

//clientCode
$show_file = new DisplaySourceFileImpl(dirname(__FILE__).'/src/test.txt');
$show_file->display();
