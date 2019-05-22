<?php

ini_set('display_errors', "On");

//---------------商品と注文---------------//

class Item {
  private $id;
  private $name;
  private $price;

  public function __construct($id, $name, $price) {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getPrice() {
    return $this->price;
  }
}

class OrderItem {
  private $item;
  private $amount;

  public function __construct(Item $item, $amount) {
    $this->item = $item;
    $this->amount = $amount;
  }

  public function getItem() {
    return $this->item;
  }

  public function getAmount() {
    return $this->amount;
  }
}

class Order {
  private $items;
  
  public function __construct() {
    $this->items = array();
  }

  public function addItem(OrderItem $order_item) {
    $this->items[$order_item->getItem()->getId()] = $order_item;
  }

  public function getItems() {
    return $this->items;
  }
}

//---------------ItemDao---------------//

class ItemDao {
  private static $instance;
  private $items;

  private function __construct() {
    $fp = fopen('item_data.txt', 'r');

    $dummy = fgets($fp, 4096);

    $this->items = array();

    while ($buffer = fgets($fp, 4096)) {
      $item_id = trim(substr($buffer, 0, 10));
      $item_name = trim(substr($buffer, 10, 20));
      $item_price = trim(substr($buffer, 30));

      $item = new Item($item_id, $item_name, $item_price);
      $this->items[$item->getId()] = $item;
    }
    fclose($fp);
  }

  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new ItemDao();
    }
    return self::$instance;
  }

  public function findById($item_id) {
    if(array_key_exists($item_id, $this->items)) {
      return $this->items[$item_id];
    } else {
      return null;
    }
  }

  public function setAside(OrderItem $order_item) {
    echo $order_item->getItem()->getName() . 'の在庫引当を行いました<br>';
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against'. get_class($this));
  }
}

//---------------OrderDao---------------//

class OrderDao {
  public static function createOrder(Order $order) {
    echo '以下の内容で注文データを作成しました';
    echo '<table>';
    echo '<tr>';
    echo '<th>商品番号</th>';
    echo '<th>商品名</th>';
    echo '<th>単価</th>';
    echo '<th>数量</th>';
    echo '<th>金額</th>';
    echo '</tr>';

    foreach($order->getItems() as $order_item) {
      echo '<tr>';
      echo '<td>'. $order_item->getItem()->getId(). '</td>';
      echo '<td>'. $order_item->getItem()->getName(). '</td>';
      echo '<td>'. $order_item->getItem()->getPrice(). '</td>';
      echo '<td>'. $order_item->getAmount(). '</td>';
      echo '<td>'. ($order_item->getItem()->getPrice() * $order_item->getAmount()). '</td>';
      echo '</tr>';
    }
    echo '</table>';
  }
}

//---------------façade---------------//

class OrderManager {
  public static function order(Order $order) {
    $item_dao = ItemDao::getInstance();

    foreach($order->getItems() as $order_item) {
      $item_dao->setAside($order_item);
    }

    OrderDao::createOrder($order);
  }
}

//---------------clientCode---------------//
$order = new Order();
$item_dao = ItemDao::getInstance();

$order->addItem(new OrderItem($item_dao->findById(1), 2));
$order->addItem(new OrderItem($item_dao->findById(2), 1));
$order->addItem(new OrderItem($item_dao->findById(3), 3));

OrderManager::order($order);