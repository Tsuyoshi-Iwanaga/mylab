<?php

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
  private $item;

  public function __construct() {
    $fp = fopen('item_data.txt', 'r');
    $dummy = fget($fp, 4096);

    $this->item = array();
    while($buffer = fgets($fp, 4096)) {
      $item_id = trim(substr($buffer, 0, 10));
      $item_name = trim(substr($buffer, 0, 10));
      $item = new Item($item_id, $item_name);
      $this->item[$item->getId()] = $item;
    }
    fclose($fp);
  }

  public function findById($item_id) {
    if(array_key_exists($item_id, $this->item)) {
      return $this->items[$item_id];
    } else {
      return null;
    }
  }
}

class DbOrderDao implements OrderDao {
  private $orders;

  public function __construct(ItemDao $item_dao) {
    $fp = fopen('order_data.txt', 'r');
    $dummy = fget($fp, 4096);

    $this->orders = array();
    while ($buffer = fgets($fp, 4096)) {
      $order_id = trim(substr($buffer, 0, 10));
      $item_ids = trim(substr($buffer, 10));

      $order = new Order($order_id);
      foreach(split(',', $item_ids) as $item_id) {
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

class MockItemDao implements ItemDao {
  public function findById($item_id) {
    $item = new Item('99', 'ダミー商品');
    return $item;
  }
}

class MockOrderDao implements OrderDao {
  public function findById($order_id) {
    $order = new Order('999');
    $order->addItem(new Item('99', 'タオル'));
    $order->addItem(new Item('99', 'パンツ'));
    $order->addItem(new Item('99', '靴下'));
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
  private $item;

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
}

$item_id = 1;
$item_dao = $facotry->createItemDao();
$item = $item_dao->findById($item_id);
echo 'ID=' . $item_id . 'の標品は' . $item->getName() . 'です<br>';

$order_id = 3;
$order_dao = $factory->createOrderDao();
$order = $order_data->findById($order_id);
echo 'ID='. $order_id . 'の注文情報は以下のとおりです';
echo '<ul>';
  foreach ($order->getItems() as $item) {
    echo '<li>' . $item['object']->getName();
  }
  echo '</ul>';
}
?>
<hr>
<form action="" method="post">
  <div>
    DaoFactoryの概要:
    <input type="radio" name="factory" value="1">DbFactory
    <input type="radio" name="factory" value="2">MockFactory
  </div>
  <div>
    <input type="submit">
  </div>
</form>
