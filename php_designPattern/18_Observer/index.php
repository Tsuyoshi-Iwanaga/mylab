<?php

//オブザーバーパターン
//監視対象のオブジェクトに何らかの変化があったときに
//関係するオブジェクトにそれを通知し協調動作を実現する

//Subject(監視される側)
class Cart {
  private $items;
  private $listeners;

  public function __construct() {
    $this->items = array();
    $this->listners = array();
  }

  public function addItem($item_cd) {
    $this->items[$item_cd] = (isset($this->items[$item_cd]) ? ++$this->items[$item_cd] : 1);
    $this->notify();
  }

  public function removeItem($item_cd) {
    $this->items[$item_cd] = (isset($this->items[$item_cd]) ? --$this->items[$item_cd]: 0);
    if($this->items[$item_cd] <= 0) {
      unset($this->items[$item_cd]);
    }
    $this->notify();
  }

  public function getItems() {
    return $this->items;
  }

  public function hasItem($item_cd) {
    return array_key_exists($item_cd, $this->items);
  }

  //Observerを登録
  public function addListener(CartListener $listener) {
    $this->listeners[get_class($listener)] = $listener;
  }

  //Observerを削除
  public function removeListener(CartListener $listener) {
    unset($this->listeners[get_class($listener)]);
  }

  //Observerへ変更を通知
  public function notify() {
    foreach($this->listeners as $listener) {
      $listener->update($this);
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


//clientCode
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