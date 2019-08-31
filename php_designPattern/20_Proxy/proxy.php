<?php
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

interface ItemDao {
  public function findById($item_id);
}

class DbItemDao implements ItemDao {
  public function findById($item_id) {
    $fp = fopen('item_data.txt', 'r');
    $dummy = fgets($fp, 4096);

    $item = null;
    while ($buffer = fgets($fp, 4096)) {
      $id = trim(substr($buffer, 0, 10));
      $name = trim(substr($buffer, 10));

      if($item_id === (int)$id) {
        $item = new Item($id, $name);
        break;
      }
    }
    fclose($fp);
    return $item;
  }
}

class MockItemDao implements ItemDao {
  public function findById($item_id) {
    $item = new Item($item_id, 'ダミー商品');
    return $item;
  }
}

class ItemDaoProxy {
  private $dao;
  private $cache;

  public function __construct(ItemDao $dao) {
    $this->dao = $dao;
    $this->cache = array();
  }

  public function findById($item_id) {
    if(array_key_exists($item_id, $this->cache)) {
      echo '<font color="#dd0000">Proxyで保持しているキャッシュからデータを返します</font><br>';
      return $this->cache[$item_id];
    }
    $this->cache[$item_id] = $this->dao->findById($item_id);
    return $this->cache[$item_id];
  }
}

//clientCode
if (isset($_POST['dal']) && isset($_POST['proxy'])) {
  $dao = $_POST['dao'];

  switch ($dao) {
    case 1:
      include_once 'MockItemDao.class.php';
      $dao = new MockItemDao();
      break;
    default:
      include_once 'DbItemDao.class.php';
      $dao = new DbItemDao();
      break;
  }

  $proxy = $_POST['proxy'];
  switch($proxy) {
    case 1:
      include_once 'ItemDaoProxy.class.php';
      $dao = new ItemDaoProxy($dao);
      break;
  }

  for ($item_id = 1; $item_id <= 3; $item_id++) {
    $item = $dao->findById($item_id);
    echo 'ID='. $item_id . 'の商品は' . $item->getName() . 'です<br>';
  }

  $item = $dao->findById(2);
  echo 'ID=' . $item_id . 'の商品は' . $item->getName() . 'です<br>';
}
?>
<hr>
<form action="" method="post">
  <div>
    Daoの種類：
    <input type="radio" name="dao" value="0" checked>DbItemDao
    <input type="radio" name="dao" value="1">MockItemDao
  </div>
  <div>
    Proxyの利用：
    <input type="radio" name="proxy" value="0" checked>しない
    <input type="radio" name="proxy" value="1">する
  </div>
  <div>
    <input type="submit">
  </div>
</form>
