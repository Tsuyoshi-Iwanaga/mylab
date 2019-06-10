<?php

ini_set('display_errors', "On");

interface DaoFactory {
  public function createItemDao();
  public function createOrderDao();
}

class DbFactory implements DaoFactory {
  public function createItemDao() {
    return new DbItemDao();
  }
  public function createOrderDao() {
    return new DbOrderDao($this->createItemDao());
  }
}

class MockFactory implements DaoFactory {
  public function createItemDao() {
    return new MockItemDao();
  }

  public function createOrderDao() {
    return new MockOrderDao();
  }
}

interface ItemDao {
  public function findById($item_id);
}

interface OrderDao {
  public function findById($order_id);
}

class DbItemDao implements ItemDao {
  private $items;

  public function __construct() {
    $fp = fopen('./src/item_data.txt', 'r');

    $dummy = fgets($fp, 4096);

    $this->items = array();
    while($buffer = fgets($fp, 4096)) {
      $item_id = trim(substr($buffer, 0, 10));
      $item_name = trim(substr($buffer, 10));

      $item = new Itme($item_id, $item_name);
      $this->items[$item->getId()] = $item;
    }

    fclose($fp);
  }

  public function findById($item_id) {
    if(array_key_exists($item_id, $this->items)) {
      return $this->items[$item_id];
    } else {
      return null;
    }
  }
}

class DbOrderDao implements OrderDao {
  private $orders;

  public function __construct(ItemDao $item_dao) {
    $fp = fopen('./src/order_data.txt', 'r');

    $dummy = fgets($fp, 4096);

    $this->orders = array();
    while ($buffer = fgets($fp, 4096)) {
      $order_id = trim(substr($buffer, 0, 10));
      $item_ids = trim(substr($buffer, 10));

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
      return null;
    }
  }
}

if(isset($_POST['factory'])) {
  $factory = $_POST['factory'];

  switch ($factory) {
    case 1:
      $factory = new DbFactory();
      break;
    case 2:
      $factory = new MockFactory();
      break;
    default:
      throw new RuntimeException('invalid factory');
  }

  $item_id = 1;
  $item_dao = $factory->createItemDao();
  $item = $item_dao->findById($item_id);
  echo 'ID='. $item_id. 'の商品は「'. $item->getName(). '」です<br>';

  $order_id = 3;
  $order_dao = $factory->createOrderDao();
  $order = $order_dao->findById($order_id);
  echo 'ID='. $order_id. 'の注文情報は次のとおりです';
  echo '<ul>';
  foreach($order->getItems() as $item) {
    echo '<li>'. $item['object']->getName();
  }
  echo '</ul>';
}
