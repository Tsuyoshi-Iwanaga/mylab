<?php
require_once 'DisplaySourceFile.class.php';
require_once 'ShowFile.class.php';

/* class1 */
class ShowFile {
  private $filename;

  public function __construct($filename) {
    if(!is_readable($filename)) {
      throw new Exception('file' . $filename . 'is not readable!');
    }
    $this->filename = $filename;
  }

  public function showPlain() {
    echo '<pre>';
    echo htmlspecialchars(fine_get_contents($this->filename), ENT_QUOTES, mb_internal_encoding());
    ehco '</pre>';
  }

  public function showHighlight() {
    highlight_file($this->filename);
  }
}

/* adopter(継承) */
class DisplaySourceFileImpl extends ShowFile implements DisplaySourceFile {
  public function __construct($filename) {
    parent::__construct($filename);
  }
  public function display() {
    parent::showHighlight();
  }
}

/* adopter(委譲) */
class DisplaySourceFileImpl implements DisplaySourceFile {
  private $show_file;

  public function __construct($filename) {
    $this->show_file = new ShowFile($filename);
  }

  public function display() {
    $this->show_file->showHighlight();
  }
}

/* client code */
require_once 'DisplaySourceFileImpl.class.php';

$show_file = new DisplaySourceFileImpl('./ShowFile.class.php');
$show_file->display();
