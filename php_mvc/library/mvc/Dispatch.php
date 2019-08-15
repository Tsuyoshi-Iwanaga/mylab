<?php

class Dispatcher {

  private $sysRoot;

  public function setSystemRoot($path) {
    $this->sysRoot = rtrim($path, '/');
  }

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
    $className = ucfirst(strtolower($controller)). 'Controller';
    require_once($this->sysRoot.'/controllers/'.$className.'.php');
    $controllerInstance = new $className();

    //2番目のパラメータを取得(action)
    $action = 'index';
    if(count($params) > 1) {
      $action = $params[1];
    }

    //コントローラのアクションメソッド実行
    $actionMethod = $action . 'Action';
    $controllerInstance->$actionMethod();
  }
}
?>