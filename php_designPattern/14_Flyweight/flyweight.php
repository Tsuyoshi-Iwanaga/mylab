<?php

class Item {
  private $code;
  private $name;
  private $price;

  public function __construct($code, $name, $price) {
    $this->code = $code;
    $this->name = $name;
    $this->price = $price;
  }

  public function getCode() {
    return $this->code;
  }

  public function getName() {
    return $this->name;
  }

  public function getPrice() {
    return $this->price;
  }
}

class ItemFactory {
  private $pool;
  private static $instance = null;

  private function __construct($filename) {
    $this->buildPool($filename);
  }

  public static function getInstance($filename) {
    if (is_null(self::$instance)) {
      self::$instance = new ItemFactory($filename);
    }
    return self::$instance;
  }

  public function getItem($code) {
    if(array_key_exists($code, $this->pool)) {
      return $this->pool[$code];
    } else {
      return null;
    }
  }

  private function buildPool($filename) {
    $this->pool = array();

    $fp = fopen($filename, 'r');
    while ($buffer = fgets($fp, 4096)) {
      list($item_code, $item_name, $price) = splint("\t", $buffer);
      $this->pool[$item_code] = new Item($item_code, $item_name, $price);
    }
    fclose($fp);
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against' . get_class($this));
  }
}

//clientCode
function dumpData($data) {
  echo '<dl>';
  foreach ($data as $object) {
    echo '<dt>' . htmlspecialchars($object->getName(), ENT_QUOTES, mb_internal_encoding()) . '</dt>';
    echo '<dd>商品番号:' . $object->getCode() . '</dd>';
    echo '<dd>\\' . number_format($object->getPrice()). '-</dd>';
  }
  echo '</dl>';
}

$factory = ItemFactory::getInstance('data.txt');

$items = array();
$items[] = $factory->getItem('ABC0001');
$items[] = $factory->getItem('ABC0002');
$items[] = $factory->getItem('ABC0003');

if ($item[0] === $factory->getItem('ABC0001')) {
  echo '同一のオブジェクトです';
} else {
  echo '同一のオブジェクトではありません';
}

dumpData($items);
