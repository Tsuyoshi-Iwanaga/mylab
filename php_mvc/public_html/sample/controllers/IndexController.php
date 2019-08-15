<?php
require_once(dirname(__FILE__).'/../../../library/smarty/Smarty.class.php');

class IndexController {

  private $view;

  public function __construct() {
    $this->view = new Smarty();
    $this->view->template_dir = '../views/templates';
  }

  public function indexAction() {
    $this->view->assign('hoge', 'Topページ');
    $this->view->display('IndexView.tpl');
  }
}
?>