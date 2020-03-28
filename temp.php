<?php
ini_set('display_errors', 'On');

abstract class ReadItemDataStrategy
{
  private $filename;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function getData() {
    if (!is_readable($this->getFilename())) {
      throw new \Exception('file is not readable');
    }
    return $this->readData($this->getFilename());
  }

  public function getFilename() {
    return $this->filename;
  }

  abstract protected function readData($filename);
}

class ReadJSONDataStrategy extends ReadItemDataStrategy
{
  protected function readData($filename) {
    $data = json_decode(file_get_contents($filename));
    return $return_value;
  }
}

class ReadTabSeparatedDataStrategy extends ReadItemDataStrategy {
  protected function readData($filename) {
    $fp = fopen($filename, 'r');
    fclose($fp);
    return $return_value;
  }
}

class ItemDataContext
{
  private $strategy;

  public function __construct(ReadItemDataStrategy $strategy) {
    $this->strategy = $strategy;
  }

  public function getItemData() {
    return $this->strategy->getData();
  }
}

echo 'TabData';
$context = new ItemDataContext(new TeadTabSeparatedDataStrategy(__DIR__.'/src/item_data.txt'));
dumpData($context->getItemData());