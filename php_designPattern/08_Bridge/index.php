<?php
ini_set('display_errors', 'On');

//ブリッジパターン
//機能と実装を分離して設計をする
//実装側のインスタンスを機能側に移譲して利用する。
//機能側からは実装側のAPIのみを知っていればよく、中身は知らなくてもOK

//-----実装-----//
interface DataSource {
  public function open();
  public function read();
  public function close();
}

class FileDataSource implements DataSource {
  private $file_name;
  private $handler;

  public function __construct($file_name) {
    $this->file_name = $file_name;
  }

  public function open() {
    if(!is_readable($this->file_name)) {
      throw new Exception('データソースが見つかりません');
    }
    $this->handler = fopen($this->file_name, 'r');
    if(!$this->handler) {
      throw new Exception('データソースのオープンに失敗しました');
    }
  }

  public function read() {
    $buffer = array();
    while(!feof($this->handler)) {
      $buffer[] = fgets($this->handler);
    }
    return join($buffer);
  }

  public function close() {
    if(!is_null($this->handler)) {
      fclose($this->handler);
    }
  }
}

//-----機能-----//
class Listing {
  private $data_source;

  public function __construct($data_source) {
    $this->data_source = $data_source;
  }

  public function open() {
    $this->data_source->open();
  }

  public function read() {
    return $this->data_source->read();
  }

  public function close() {
    $this->data_source->close();
  }
}

class ExtendedListing extends Listing {
  public function __construct($data_source) {
    parent::__construct($data_source);
  }

  public function readWithEncode() {
    return strtoupper($this->read());
  }
}

//クライアントコード
$list1 = new Listing(new FileDataSource('./src/data.txt'));
$list2 = new ExtendedListing(new FileDataSource('./src/data.txt'));

try {
  $list1->open();
  $list2->open();
} catch(Exception $e) {
  die($e->getMessage());
}

$data1 = $list1->read();
echo $data1;

echo '<hr>';

$data2 = $list2->readWithEncode();
echo $data2;

$list1->close();
$list2->close();
?>