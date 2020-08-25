<?php

abstract class Application
{
  protected $debug = false;
  protected $request;
  protected $response;
  protected $session;
  protected $db_manager;

  //コンストラクタ
  public function __construct($debug = false)
  {
    $this->setDebugMode($debug);
    $this->initialize();
    $this->configure();
  }

  //デバッグモードの設定
  public function setDebugMode($debug)
  {
    if($debug) {
      $this->debug = true;
      ini_set('display_errors', 1);
      error_reporting(-1);
    } else {
      $this->debug = false;
      ini_set('display_errors', 0)
    }
  }

  //アプリケーションの初期化
  protected function initialize()
  {
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->db_manager = new DbManager();
    $this->router = new Router($this->registerRoutes());
  }

  //アプリケーションの設定
  protected function configure() {}

  //プロジェクトのルートディレクトリ取得
  abstract public function getRootDir();

  //ルーティング情報を取得して返す
  abstract public function registerRoutes();

  //デバックモードかの判定
  public function idDebugMode()
  {
    return $this->debug;
  }

  //Requestオブジェクト取得
  public function getRequest()
  {
    return $this->request;
  }

  //Responseオブジェクト取得
  public function getResponse()
  {
    return $this->response;
  }

  //Sessionオブジェクトを取得
  public function getSession()
  {
    return $this->session;
  }

  //DbManagerの取得
  public function getDbManager()
  {
    return $this->db_manager;
  }

  //コントローラのパスを取得
  public function getControllerDir()
  {
    return $this->getRootDir(). '/controllers';
  }

  //ビューへのパスを取得
  public function getViewDir()
  {
    return $this->getRootDir(). '/views';
  }

  //モデルへのパスを取得
  public function getModelDir()
  {
    return $this->getRootDir(). '/models';
  }

  public function run()
  {
    //1.
    $params = $this->router->resolve($this->request->getPathInfo());
    if($params === false) {
      throw new HttpNotFoundException('No route found for '.
        $this->request->getPathInfo());
    }

    $controller = $params['controller'];
    $action = $params['action'];

    $this->runAction($controller, $action, $params);

  } catch (HttpNotFoundException $e) {
    $this->render404Page($e);

  } catch (UnauthorizedActionException $e) {
    list($controller, $action) = $this->login_action;
    $this->runAction($controller, $action);
  }

  $this->response->send();
}