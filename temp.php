<?php
ini_set('display_errors', 'On');

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

class DisplaySourceFileImpl implements DisplaySourceFile {
  private $show_file;

  public function __construct($filename) {
    $this->show_file = new ShowFile($filename);
  }

  public function display() {
    $this->show_file->showHightlight();
  }
}

$show_file = new DisplaySourceFileImppl(dirname(__FILE__).'/src/test.txt');
$show_file->display();