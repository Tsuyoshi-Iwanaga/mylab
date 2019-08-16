<?php

abstract class ControllerBase {

  protected $systemRoot;
  protected $controller = 'index';
  protected $action = 'index';
  protected $view;
  protected $request;
  protected $templatePath;

  public function __construct() {
    $this->request = new Request();
  }

  public function setSystemRoot($path) {
    $this->systemRoot = $path;
  }

  public function setControllerAction($controller, $action) {
    $this->controller = $controller;
    $this->action = $action;
  }

  public function run() {
    try {
      $this->initializeView();
      $this->preAction();
      $methodName = sprintf('%sAction', $this->action);
      $this->$methodName();
      $this->view->display($this->templatePath);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  //ビュー初期化
  protected function initializeView() {
    $this->view = new Smarty();
    $this->view->template_dir = sprintf('%s/views/templates/', $this->systemRoot);
    $this->view->compile_dir = sprintf('%s/views/templates_c/', $this->systemRoot);
    $this->templatePath = sprintf('%s/views/templates/%sView.tpl', $this->systemRoot, $this->controller);
  }

  //共通前処理(オーバライド前提)
  protected function preAction() {}
}

?>