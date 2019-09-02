<?php
ini_set('display_errors', "On");

//Façadeパターン
//Mainクラスに複雑な処理を書かなければいけない場合に、
//一連の操作をまとめたわかりやすいAPIを用意しておく

//商品クラス
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

//注文クラス(商品のインスタンスと数量を保持する)
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

//注文をまとめるクラス
class Order {
  private $orders;

  public function __construct() {
    $this->orders = array();
  }

  public function addItem(OrderItem $order_item) {
    $this->orders[$order_item->getItem()->getId()] = $order_item;
  }

  public function getItems() {
    return $this->orders;
  }
}

//商品のDAO(Database Access Object)クラス
class ItemDao {
  private static $instance;
  private $items;

  private function __construct() {
    $this->items = [];

    $fp = fopen(dirname(__FILE__).'/src/item_data.txt', 'r');
    $dummy = fgets($fp, 4096);

    while(($buffer = fgets($fp, 4096)) !== false) {
      $data = explode("\t", trim($buffer));
      if (count($data) !== 3) {
        continue;
      }
      list($item_id, $item_name, $item_price) = $data;
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
      return;
    }
  }

  public function setAside(OrderItem $order_item) {
    printf('%sの在庫引当をおこないました<br>', $order_item->getItem()->getName());
  }

  final public function __clone() {
    throw new RuntimeException('Clone is not allowed aginst'.get_class($this));
  }
}

//注文のDAO(Database Access Object)クラス
//※本来はDBにアクセスなどするが、今回は注文内容を出力するだけ
class OrderDao {
  public static function createOrder(Order $order) {
    echo '以下の内容で注文データを作成しました<br>';

    echo '<table border=1>';
    echo '<tr><td>商品番号</td><td>商品名</td><td>単価</td><td>数量</td><td>金額</td></tr>';
    foreach($order->getItems() as $order_item) {
     echo '<tr>';
     echo '<td>'.$order_item->getItem()->getId().'</td>';
     echo '<td>'.$order_item->getItem()->getName().'</td>';
     echo '<td>'.$order_item->getItem()->getPrice().'</td>';
     echo '<td>'.$order_item->getAmount().'</td>';
     echo '<td>'.($order_item->getItem()->getPrice() * $order_item->getAmount()).'</td>';
     echo '</tr>';
    }
    echo '</table>';
  }
}

//統一APIを提供するFaçadeクラス
class OrderManager {
  public static function order(Order $order) {
    $item_dao = ItemDao::getInstance();
    foreach ($order->getItems() as $order_item) {
      $item_dao->setAside($order_item);
    }
    OrderDao::createOrder($order);
  }
}

//clientCode
$order = new Order();
$item_dao = ItemDao::getInstance();

$order->addItem(new OrderItem($item_dao->findById(1), 2));
$order->addItem(new OrderItem($item_dao->findById(2), 1));
$order->addItem(new OrderItem($item_dao->findById(3), 3));

//統一APIを利用
OrderManager::order($order);