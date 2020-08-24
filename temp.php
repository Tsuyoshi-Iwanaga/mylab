<?php

//Subject
class Cart {
  private $items;
  private $listeners;

  public function __construct() {
    $this->items = array();
    $this->listners = array();
  }

  public function addItem($item_cd) {
    $this->items[$item_cd] = (isset($this->items[$item_cd]) ? ++ $this->items[$item_cd] : 1);
    $this->notify();
  }

  public function emoveItem($item_cd) {
    $this->items[$item_cd] = (isset($this->items[$item_cd]) ? -- $this->items[$item_cd] : 0);
    if($this->items[$item_cd] <= 0) {
      unset($this->items[$item_cd]);
    }
    $this->notify();
  }
}

<<<<<<< HEAD
class Employee extents OrganizationEntry {
  public function __construct($code, $name) {
    parent::__construct($code, $name);
  }

  public function add(OrganizationEntry $entry) {
    throw new Exception('method not allowed');
  }
}

<<<<<<< HEAD
  public function getItems() {
    return $this->items;
=======
$root_entry = new Group('001', '本社');
$root_entry->add(new Emploee("00101", "CEO"));
$root_entry->add(new Emploee("00102", "CTO"));

$group1 = new Group("010", "〇〇支店");
$group1->add(new Employee("01001", "支店長"));
$group1->add(new Employee("01002", "佐々木"));
$group1->add(new Employee("01003", "鈴木"));
$group1->add(new Employee("01003", "吉田"));

$group2 = new Group("110", "▲▲営業所");
$group2->add(new Employee("11001", "川村"));

$group1->add($group2);
$root_entry->add($group1);

$group3 = new Group("020", "××支店");
$group3->add(new Employee("02001", "荻原"));
$group3->add(new Employee("02002", "田島"));
$group3->add(new Employee("02002", "白井"));
$root_entry->add($group3);

$root_entry->dump();
=======
  public function getFilename() {
    return $this->filename;
>>>>>>> c45c1a9736ad42f7b8f2819d35a363208baf6926
  }

  public function hasItem($item_cd) {
    return array_key_exists($item_cd, $this->items);
  }

  //Observer登録
  public function addListener(CartListner $listener) {
    $this->listeners[get_class($listener)] = $listener;
  }

  //Observer削除
  public function removeListener(CartListner $listener) {
    unset($this->listeners[get_class($listener)]);
  }

  //Observerへ変更を通知
  public function notify() {
    foreach($this->listerner as $listener) {
      $listerner->update($this);
    }
  }

  public function show() {
    $line = str_repeat('-', 40).'<br>';
    echo $line;
    echo "商品名\t個数".'<br>';
    echo $line;
    foreach($this->getItems() as $item_name => $quantity) {
      echo $item_name."\t".$quantity.'<br>';
    }
    echo $line;
  }
}

//Observer
interface CartListener {
  public function update(Cart $cart);
}

//ConcreteObserver01
class PresentListener implements CartListener {
  const PRESENT_TARGET_ITEM = 'クッキーセット';
  const PRESENT_ITEM = 'プレゼント';

  public function __construct() {
  }

  public function update(Cart $cart) {
    if($cart->hasItem(self::PRESENT_TARGET_ITEM) && !$cart->hasItem(self::PRESENT_ITEM)) {
      $cart->addItem(self::PRESENT_ITEM);
    }
    if(!$cart->hasItem(self::PRESENT_TARGET_ITEM) && $cart->hasItem(self::PRESENT_ITEM)) {
      $cart->removeItem(self::PRESENT_ITEM);
    }
  }
}

//ConcreteObserver02
class LoggingLIstener implements CartListener {
  public function __construct() {
  }

  public function update(Cart $cart) {
    echo var_export($cart->getItems(), true).'<br>';
  }
}

<<<<<<< HEAD
//client
$cart = new Cart();
$cart->addListener(new PresentListener());
$cart->addListener(new LoggingListener());

$cart->addItem("Tシャツ");
$cart->addItem("ぬいぐるみ");
$cart->addItem("ぬいぐるみ");
$cart->addItem("クッキーセット");
$cart->addItem("クッキーセット");
$cart->addItem("クッキーセット");
$cart->removeItem("クッキーセット");
$cart->removeItem("クッキーセット");
$cart->removeItem("クッキーセット");
$cart->show();
=======
echo 'JSON';
$context = new ItemDataContext(new ReadJSONDataStrategy(__DIR__.'item_data.json'));
dumpData($context->getItemData());
>>>>>>> 6b53fdd2e74a580608b1ad804f763c959c9e34ed
>>>>>>> c45c1a9736ad42f7b8f2819d35a363208baf6926
