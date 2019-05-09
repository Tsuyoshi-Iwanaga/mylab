<?php

class Cart {
  private $items;
  private $listeners;

  public function __construct() {
    $this->items = array();
    $this->listners = array();
  }

  public function addItem($item_cd) {
    $this->items[$item_cd] = (isset($this->items[$item_cd]) ? ++$this->items[$item_cd]: 1);
    $this->notify();
  }

  public function removeItem($item_cd) {
    $this->items[$item_cd] = (isset($this->items[$item_cd] ? --$this->item[$item_cd]: 0));
    if($this->item[$item_cd] <= 0) {
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

  public function addListener(CartListener $listeners) {
    $this->listeners[get_class($listener)] = $listener;
  }

  public function removeListener(CartListener $listener) {
    unset($this->listeners[get_class($listener)]);
  }

  public function notify() {
    foreach($this->listeners as $listener) {}
      $listener->update($this);
  }
}

interface CartListener {
  public function update(Cart $cart);
}

class PresentListener implements CartListener {
  private static $PRESENT_TARGET_ITEM = '30:クッキーセット';
  private static $PRESENT_ITEM = '99:プレゼント';

  public function __construct() {

  }

  public function update(Cart $cart) {
    if($cart->hasItem(self::$PRESENT_TARGET_ITEM) && !$cart->hasItem(self::$PRESENT_ITEM)) {
      $cart->addItem(self::$PRESENT_ITEM);
    }
    if($cart->hasItem(self::$PRESENT_TARGET_ITEM) && $cart->hasItem(self::$PRESENT_ITEM)) {
      $cart->removeItem(self::$PRESENT_ITEM);
    }
  }
}

class LoggingListener implements CartListener {
  public function __construct() {
  }

  public function update(Cart $cart) {
    echo '<pre>';
    var_dump($cart->getItems());
    echo '</pre>';
  }
}

function createCart() {
  $cart = new Cart();
  $cart->addListener(new PresentListener());
  $cart->addListener(new LoggingListener());

  return $cart;
}

session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
if(is_null($cart)) {
  $cart = createCart();
}

$item = (isset($_POST['item'] ? $_POST['item'] : ''));
$mode = (isset($_POST['mode'] ? $_POST['mode'] : ''));

switch ($mode) {
  case 'add':
    echo '<p>追加しました</p>';
    $cart->addItem($item);
    break;
  case 'remove':
    echo '<p>削除しました</p>';
    $cart->removeItem($item);
    break;
  case 'clear';
    echo '<p>クリアしました</p>';
    $cart = createCart();
    break;
}

$_SESSION['cart'] = $cart;

echo '<h1>商品一覧</h1>';
echo '<ul>';
foreach($cart->getItem() as $item_name => $quantity) {
  echo '<li>'. $item_name. ' ' .$quantity. '個</li>';
}
?>
<form action="" method="post">
<select name="item">
<option value="10:Tシャツ">Tシャツ</option>
<option value="20:ぬいぐるみ">ぬいぐるみ</option>
<option value="30:クッキーセット">クッキーセット</option>
</select>
<input type="submit" name="mode" value="add">
<input type="submit" name="mode" value="remove">
<input type="submit" name="mode" value="clear">
</form>
