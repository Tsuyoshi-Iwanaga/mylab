<?php

class User {
  private $name;
  private $state;
  private $count = 0;

  public function __construct($name) {
    $this->name = $name;

    $this->state = UnautorizedState::getInstance();
    $this->resetCount();
  }

  public function switchState() {
    echo '状態遷移'. get_class($this->state). '→';
    $this->state = $this->state->nextState();
    echo get_class($this->state). '<br>';
    $this->resetCount();
  }

  public function isAuthenticated() {
    return $this->state->isAuthenticated();
  }

  public function getMenu() {
    return $this->state->getMenu();
  }

  public function getUserName() {
    return $this->name;
  }

  public function getCount() {
    return $this->count;
  }

  public function incrementCount() {
    $this->count++;
  }

  public function resetCount() {
    $this->count = 0;
  }
}

//StateClass
interface UserState {
  public function isAnthenicated();
  public function nextState();
  public function getMenu();
}

class AuthorizedState implements UserState {
  private static $singleton = null;

  private function __construct() {

  }

  public static function getInstance() {
    if(self::$singleton == null) {
      self::$singleton = new AuthorizedState();
    }
    return self::$singleton;
  }

  public function isAuthenticated() {
    return true;
  }

  public function nextState() {
    return UnauthorizedState::getInstance();
  }

  public function getMenu() {
    $menu = '<a href="?mode=inc"カウントアップ</a> | <a href="?mode=reset">リセット</a> | <a href="?mode=state">ログアウト</a>';
    return $menu;
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against'. get_class($this));
  }
}

class UnauthorizedState implements UserState {
  private static $singleton = null;

  private function __construct() {

  }

  public static function getInstance() {
    if(self::$singleton === null) {
      self::$singleton = new UnauthorizedState();
    }
    return self::$singleton;
  }

  public function isAuthenticated() {
    return false;
  }

  public function nextState() {
    return AuthorizedState::getInstance();
  }

  public function getMenu() {
    $menu = '<a href="?mode=state">ログイン</a>';
    return $menu;
  }

  public final function __clone() {
    throw new RuntimeException('Clone is not allowed against'. get_class($this));
  }
}

//clientCode
session_start();

$context = isset($_SESSION['context']) ? $_SESSION['context'] : null;

if(is_null($context)) {
  $context = new User('ほげ');
}

$mode = (isset($_GET['mode']) ? $_GET['mode'] : '');

switch ($mode) {
  case 'state':
    echo '<p>状態を遷移します</p>';
    $context->switchState();
    break;
  case 'inc':
    echo '<p>カウントアップします</p>';
    $context->incrementCount();
  case 'reset':
    echo '<p>カウントをリセットします</p>';
    $context->resetCount();
    break;
}

$_SESSION['context'] = $context;

echo 'ようこそ'. $context->getUserName(). 'さん';
echo '現在、ログインして'. ($context->isAuthenticated() ? 'います' : 'いません');
echo '現在のカウント:'. $context->getCount();
echo $context->getMenu();
