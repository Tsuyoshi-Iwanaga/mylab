<?php
//---------------Adaptee---------------//

class ShowFile {
  private $filename;

  public function __construct($filename) {
    if (!is_readable($filename)) {
      throw new Exception('file'. $filename. 'is not readable!');
    }
    $this->filename = $filename;
  }

  public function showPlain() {
    echo '<pre>';
    echo htmlspecialchars(file_get_contents($this->filename), ENT_QUOTES, mb_internal_encoding());
    echo '</pre>';
  }

  public function showHighlight() {
    highlight_file($this->filename);
  }
}

//---------------Target---------------//

interface DisplaySourceFile {
  public function display();
}

//---------------Adapter(extends)---------------//

class DisplaySourceFileImpl extends ShowFile implements DisplaySourceFile {
  public function __construct($filename) {
    parent::__construct($filename);
  }

  public function display() {
    parent::showHighlight();
  }
}

//---------------Adapter(deligate)---------------//

class DisplaySourceFileImpl implements DisplaySourceFile {
  private $show_file;

  public function __construct($filename) {
    $this->show_file = new ShowFile($filename);
  }

  public function display() {
    $this->show_file->showHighlight();
  }
}

//---------------client---------------//

$show_file = new DisplaySourceFileImpl('./ShowFile.class.php');
$show_file->display();
