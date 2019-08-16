<?php
require_once(dirname(__FILE__).'/../../../library/smarty/Smarty.class.php');
require_once(dirname(__FILE__).'/../../../library/mvc/ControllerBase.php');

class IndexController extends ControllerBase {

  public function indexAction() {
    $this->view->assign('hoge', 'Topページ');
    //$this->view->display('IndexView.tpl');
  }
}
?>