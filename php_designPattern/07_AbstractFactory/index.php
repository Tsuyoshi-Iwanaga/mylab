<?php
ini_set('display_errors', 'On');

//★アブストラクトファクトリーパターン
//関連するオブジェクト群を生成するファクトリを提供する
//ファクトリ経由で生成することで整合性が保たれる。
//またファクトリ自体を切り替えることで一気に生成オブジェクトを切り替える事ができる

//AbstractFactory
interface DaoFactory {
  public function createItemDao();
  public function createOrderDao();
}

//ConcreteFactory01(シングルトンを適用)
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

//ConcreteFactory01(シングルトンを適用)
class MockFactory implements DaoFactory {

  private static $instance;

  private function __construct() {}
  
  public static function getInstance() {
    if(!isset(self::$instance)) {
      self::$instance = new MockFactory();
    }
    return self::$instance;
  }

  public function createItemDao() {
    return new MockItemDao();
  }

  public function createOrderDao() {
    return new MockOrderDao();
  }
}

//ItemDao
interface ItemDao {
  public function findById($item_id);
}

class DbItemDao implements ItemDao {
  private $items;

  public function __construct() {
    $fp = fopen(dirname(__FILE__).'/src/item_data.txt', 'r');
    $dummy = fgets($fp, 4096);

    $this->items = array();

    while(($buffer = fgets($fp, 4096)) !== false) {
      $data = explode("\t", trim($buffer));
      if(count($data) !== 2) {
        continue;
      }
      list($item_id, $item_name) = $data;

      $item = new Item($item_id, $item_name);
      $this->items[$item->getId()] = $item;
    }
    fclose($fp);
  }

  public function findById($item_id) {
    if(array_key_exists($item_id, $this->items)) {
      return $this->items[$item_id];
    } else {
      return;
    }
  }
}

class MockItemDao implements ItemDao {
  public function findById($item_id) {
    $item = new Item('99', 'ダミー商品');
    return $item;
  }
}

//OrderDao
interface OrderDao {
  public function findById($order_id);
}

class DbOrderDao implements OrderDao {
  private $orders;

  public function __construct(ItemDao $item_dao) {
    $fp = fopen(dirname(__FILE__). '/src/order_data.txt', 'r');

    $dummy = fgets($fp, 4096);

    $this->orders = array();
  
    while(($buffer = fgets($fp, 4096)) !== false) {
      $data = explode("\t", trim($buffer));
      if(count($data) !== 2) {
        continue;
      }
      list($order_id, $item_ids) = $data;
  
      $order = new Order($order_id);

      foreach(explode(',', $item_ids) as $item_id) {
        $item = $item_dao->findById($item_id);
        if(!is_null($item)) {
          $order->addItem($item);
        }
      }
      $this->orders[$order->getId()] = $order;
    }
    fclose($fp);
  }

  public function findById($order_id) {
    if(array_key_exists($order_id, $this->orders)) {
      return $this->orders[$order_id];
    } else {
      return;
    }
  }
}

class MockOrderDao implements OrderDao {
  public function findById($order_id) {
    $order = new Order('999');
    $order->addItem(new Item('99', 'ダミー商品'));
    $order->addItem(new Item('99', 'ダミー商品'));
    $order->addItem(new Item('99', 'ダミー商品'));

    return $order;
  }
}

//Models
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

  public function __construct($id) {
    $this->id = $id;
    $this->items = array();
  }

  public function addItem(Item $item) {
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

//clientCode
function show (DaoFactory $factory) {
  $item_id = 1;
  $item_dao = $factory->createItemDao();
  $item = $item_dao->findById($item_id);
  printf("ID=%sの商品は「%s」です<br>", $item_id, $item->getName());

  $order_id = 3;
  $order_dao = $factory->createOrderDao();
  $order = $order_dao->findById($order_id);
  printf("ID=%sの注文情報は次の通りです<br>", $order_id);
  foreach($order->getItems() as $item) {
    printf("%s<br>", $item['object']->getName());
  }
}

show(DbFactory::getInstance());
echo('<hr>');
show(MockFactory::getInstance());