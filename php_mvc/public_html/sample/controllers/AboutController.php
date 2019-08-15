<?php
require_once(dirname(__FILE__).'/../../../library/mvc/Request.php');
require_once(dirname(__FILE__).'/../../../library/smarty/Smarty.class.php');

class AboutController {

  private $request;
  private $veiw;

  public function __construct() {
    $this->request = new Request();
    $this->view = new Smarty();
    $this->view->template_dir = '../views/templates';
  }

  public function indexAction() {

    // リクエスト情報の取得
    // $req= new Request();
    // $params = $req->getParam();
    // $userId = $params['user_id'];

    // Modelインスタンス生成
    // $cart = new Cart();
    // $cartProduct = new CartProduct();

    // Modelからデータ取得
    // $cartInfo = $cart->getUserCart($userId);
    // $products = $cartProduct->getProductList($cartInfo['cart_id']);

    //Viewへの変数割り当て
    $this->view->assign('hoge', 'aboutページ');
    $this->view->assign('query', $this->request->getQuery('hoge'));
    
    //Viewの表示
    $this->view->display('AboutView.tpl');
  }
}
?>