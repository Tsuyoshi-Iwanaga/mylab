<?php

require_once '<DisplaySourceFile.class.php';
require_once 'ShowFile.class.php';

class ShowFile {
  private $filename;

  public function __construct($filename) {
    if(!is_readable($filename)) {
      throw new Exception('file'. $filename . 'is not required!');
    }
    $this->filename = $filename;
  }
}

public function showPlain() {
  echo '<pre>',
  echo htmlspecialchars(file_get_contents($this->filename), ENT_QUOTES, mb_internal_encoding());
  echo '</pre>';
}

public function showHighlight() {
  highlight_file($this->filename);
}
}

class DisplaySourceFileImple extends ShowFile implemants DisplaySourceFile {
  public function __construct($filename) {
    parent::__construct($filename);
  }
  public function display() {
    parent::showHighlight();
  }
}

class DisplaySourceFileImple implements DisplaySourceFile {
  private $show_file,

  public function __construct($filename) {
    $this->show_file = new ShowFile($filename);
  }

  public function display() {
    $this->show_file->showHighlight();
  }
}

require_once 'DisplaySourceFileImpl.class.php';

$show_file = new DisplaySourceFileImpl('./ShowFile.class.php');
$show_file->display();
