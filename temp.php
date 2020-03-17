<?php
ini_set('display_errors', 'On');

abstract class ReadItemDataStrategy
{
  private $filename;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function getData() {
    return $this->readData($this->getFilename());
  }

  public function getFilename() {
    return $this->filename;
  }

  abstract protected function readData($filename);
}

class ReadJsonDataStrategy extends ReadItemDataStrategy
{
  protected function readData($filename) {
    return 'data';
  }
}

class ReadTabSeparatedDataStrategy extends ReadItemDataStrategy {
  protected function readData($filename) {
    return 'hoge';
  }
}

class ItemDateContext
{
  private $strategy;

  public function __construct(ReadItemDataStrategy $strategy) {
    $this->strategy = $strategy;
  }

  public function getItemData() {
    return $this->strategy->getData();
  }
}

$context = new ItemDateContext(new ReadTabSeparatorDataStrategy('a.txt'));
$context->getItemData();