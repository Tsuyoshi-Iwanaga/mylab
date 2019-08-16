<?php

require_once(dirname(__FILE__).'/../smarty/Smarty.class.php');
require_once('Request.php');

class Dispatcher {

  private $sysRoot;

  public function setSystemRoot($path) {
    $this->sysRoot = rtrim($path, '/');
  }

  //振り分け処理
  public function dispatch() {

    //リクエスト情報のパース
    $param = preg_replace('/\/php_mvc\//i', '', $_SERVER['REQUEST_URI']);
    $param = preg_replace('/\?.+$/i', '', $param);

    $params = array();
    if($param != '') {
      $params = explode('/', $param);
    }
    
    //1番目のパラメータを取得(controller)
    $controller = 'index';
    if(count($params) > 0) {
      $controller = $params[0];
    }

    //コントローラインスタンスを生成
    $controllerInstance = $this->getControllerInstance($controller);
    if($controller == null) {
      header("HTTP/1.0 404 Not Found");
      exit;
    }

    //2番目のパラメータを取得(action)
    $action = 'index';
    if(count($params) > 1) {
      $action = $params[1];
    }
    
    //アクションメソッドの存在確認
    if(method_exists($controllerInstance, $action.'Action') == false) {
      header("HTTP/1.0 404 Not Found");
      exit;
    }

    //コントローラ初期設定・実行
    $controllerInstance->setSystemRoot($this->sysRoot);
    $controllerInstance->setControllerAction($controller, $action);
    $controllerInstance->run();
  }

  private function getControllerInstance($controller) {
    $className = ucfirst(strtolower($controller)).'Controller';
    $controllerFileName = sprintf('%s/controllers/%s.php', $this->sysRoot, $className);

    if(file_exists($controllerFileName) == false) {
      return null;
    }

    require_once $controllerFileName;

    if(class_exists($className) == false) {
      return null;
    }

    $controllerInstance = new $className();
    return $controllerInstance;
  }
}
?>