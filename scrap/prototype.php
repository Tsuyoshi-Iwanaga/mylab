<?php

abstract class ItemPrototype {
  private $item_code;
  private $item_name;
  private $price;
  private $detail;

  public function __construct($code, $name, $price) {
    $this->item_code = $code;
    $this->item_name = $name;
    $this->price = $price;
  }

  public function getCode() {
    return $this->item_code;
  }

  public function getName() {
    return $this->item_name;
  }

  public function getPrice() {
    return $this->price;
  }

  public function setDetail(stdClass $detail) {
    $this->detail = $detail;
  }

  public function getDetail() {
    return $this->detail;
  }

  public function dumpData() {
    echo '<dl>';
    echo '<dt>' . $this->getName() . '</dt>';
    echo '<dd>商品番号:' . $this->getCode() . '</dd>';
    echo '<dd>\\' . number_format($this->getPrace()) . '-</dd>';
    echo '<dd>' . $this->detail->comment . '</dd>';
    echo '</dl>';
  }

  public function newInstance() {
    $new_instance = clone $this;
    return $new_instance;
  }

  protected abstract function __clone();
}

class DeepCopyItem extends ItemPrototype {
  protected function __clone() {
    $this->setDetail(clone $this->getDetail());
  }
}

class ShallowCopyItem extends ItemPrototype {
  protected function __clone() {
    //空の実装
  }
}

class ItemManager {
  private $items;

  public function __construct() {
    $this->items = array();
  }

  public function registItem(ItemPrototype $item) {
    $this->items[$item->getCode()] = $item;
  }

  public function create($item_code) {
    if (!array_key_exists($item_code, $this->items)) {
      throw new Exception('item_code [' . $item_code .'] not exists!');
    }
    $cloned_item = $this->items[$item_code]->newInstance();
    return $cloned_item;
  }
}

//clientCode
function testCopy(ItemManager $manager, $item_code) {
  $item1 = $manager->create($item_code);
  $item2 = $manager->create($item_code);

  $item2->getDetail()->comment = 'コメントを書き換えました';

  echo '■オリジナル';
  $item->dumpData();
  echo '■コピー';
  $item2->dumpData();
  echo '<hr>';
}

$manager = new ItemManager();

$item = new DeepCopyItem('ABC0001', '限定Tシャツ', 3800);
$detail = new stdClass();
$detail->comment = '商品Aのコメントです';
$item->setDetail($detail);
$manager->registItem($item);

$item = new ShallowCopyItem('ABC0002', 'ぬいぐるみ', 1500);
$detail = new stdClass();
$detail->comment = '商品Bのコメントです';
$item->setDetail($detail);
$manager->registItem($item);

testCopy($manager, 'ABC0001');
testCopy($manager, 'ABC0002');
