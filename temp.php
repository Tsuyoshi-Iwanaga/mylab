<?php
ini_set('display_errors', 'On');

//====== Factory =====//
interface DaoFactory {
  public function createItemDao();
  public function createOrderDao();
}

class DbFactory implements DaoFactory {
  private static $instance;

  private function __construct() {}

  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new DbFactory();
    }
    return self::$instance;
  }

  public function createItemDao() {
    return new DbItemDao();
  }

  public function createOrderDao() {
    return new DbOrderDao($this->createItemDao());
  }
}

class MockFactory implements DaoFactory {
  private static $instance;

  private function __coustruct() {}

  public static function getInstance() {
    return self::$instance;
  }

  public function createItemDao() {
    return new MockItemDao();
  }

  public function createOrderDao() {
    return new MockOrderDao();
  }
}

//====== ItemDao =====//
interface ItemDao {
  public function findById($item_id);
}

class DbItemDao implements ItemDao {
  public function __construct() {
    //fileread,
    //Search on id
  }
}

class MockItemDao implements ItemDao {
  public function findById($item_id) {
    $item = new Item('99', 'ダミー商品');
    return $itme;
  }
}

//====== OrderDao =====//
interface OrderDao {
  public function findById($order_id);
}

class DbOrderDao implements OrderDao {
  private $orders;

  public function __construct(ItemDao $item_dao) {
    //fileRead
  }

  public function findById($order_id) {
    if(array_key_exists($order_id, $this->orders)) {
      return $this->orders[$order_id];
    } else {
      return 
    }
  }
}

class MockOrderDao implements OrderDao {
  public function findById($order_id) {
    $order = new Order('999');
    $order->addItem(new Item('99', 'ダミー商品'));
    $order->addItem(new Item('99', 'ダミー商品'));
    $order->addItem(new item('99', 'ダミー商品'));

    return $order;
  }
}

class Item {
  private $id;
  private $name;

  public function __construct($id, $name) {
    $this->id = $id;
    $this->name = $name;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }
}

class Order {
  private $id;
  private $items;

  public function __construct(Item $item) {
    $id = $item->getId();

    if(!array_key_exists($id, $this->items)) {
      $this->items[$id]['object'] = $item;
      $this->items[$id]['amount'] = 0;
    }
    $this->items[$id]['amount']++;
  }

  public function getItems() {
    return $this->items;
  }

  public function getId() {
    return $this->id;
  }
}

$factory = DbFactory::getInstance();
// $factory = MockFactory::getInstane();

$item_id = 1;
$item_dao = $factory->createItemDao();
$item = $item_dao->findById($item_id);

$order_id = 3;
$order_dao = $factory->createOrderDao();
$order = $order_dao->findById($order_id);
foreach($order->getItems() as $item) {
  printf("%s<br>", $item['object']->getName());
}