<?php
ini_set('display_errors', 'On');

//ストラテジーパターン

//Strategy統括クラス
abstract class ReadItemDataStrategy
{
  private $filename;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function getData() {
    if (!is_readable($this->getFilename())) {
      throw new \Exception('file ['.$this->getFilename().'] is not readable !');
    }
    return $this->readData($this->getFilename());
  }

  public function getFilename() {
    return $this->filename;
  }

  abstract protected function readData($filename);
}

//readDataの具体的な実装01(取替え可能)
class ReadJsonDataStrategy extends ReadItemDataStrategy
{
  protected function readData($filename) {
    $data = json_decode(file_get_contents($filename));

    foreach ($data as $line) {
      $obj = new stdClass();
      $obj->item_name = $line->item_name;
      $obj->item_id = $line->item_id;
      $obj->price = $line->price;
      $obj->release_date = new DateTime($line->release_date);

      $return_value[] = $obj;
    }

    return $return_value;
  }
}

//readDataの具体的な実装02(取替え可能)
class ReadTabSeparatedDataStrategy extends ReadItemDataStrategy {

  protected function readData($filename) {
    $fp = fopen($filename, 'r');

    $dummy = fgets($fp, 4096);//ヘッダー抜く

    $return_value = array();

    while (($buffer = fgets($fp, 4096)) !== false) {

      $data = explode("\t", trim($buffer));

      if (count($data) !== 4) {
        continue;
      }

      list($item_id, $item_name, $price, $release_date) = $data;

      $obj = new \stdClass();
      $obj->item_name = $item_name;
      $obj->item_id = $item_id;
      $obj->price = $price;
      $obj->release_date = new \DateTime($release_date);

      $return_value[] = $obj;
    }

    fclose($fp);

    return $return_value;
  }
}

//Contextクラス
//Strategyオブジェクトを内部に格納する
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

//client
function dumpData($data)
{
  foreach ($data as $object) {
    echo $object->item_name.'<br>';
    echo $object->item_id.'<br>';
    echo number_format($object->price).'<br>';
    echo $object->release_date->format('Y/m/d').'発売'.'<br>';
  }
}

echo 'タブ区切りデータ';
$context = new ItemDataContext(new ReadTabSeparatedDataStrategy(__DIR__.'/src/item_data.txt'));
dumpData($context->getItemData());

echo '<hr>';

echo 'JSONデータ';
$context = new ItemDataContext(new ReadJsonDataStrategy(__DIR__.'/src/item_data.json'));
dumpData($context->getItemData());
?>