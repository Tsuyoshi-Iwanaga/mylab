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
      ini_set('display_erros', 0);
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

  //プロジェクトルートディレクトリを取得
  abstract public function getRootDir();

  //ルーティング情報取得して返す(※initializeメソッド内からコール)
  abstract public function registerRoutes();

  //デバッグモードか判定
  public function isDebugMode()
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

  //DbManagerオブジェクトを取得
  public function getDbManager()
  {
    return $this->db_manager;
  }

  //コントローラへのパスを取得
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

  //アプリケーションの実行
  public function run()
  {
    try {
      //1. リクエストされたパス情報が順番に格納された配列を取得(/aaa/bbb なら [hoge, aaa])
      $params = $this->router->resolve($this->request->getPathInfo());
      if($params === false) {
        throw new HttpNotFoundException('No route found for '. $this->request->getPathInfo());
      }

      //2. params配列からコントローラ名とアクション名を取得
      $controller = $params['controller'];
      $action = $params['action'];

      //3. コントローラ名とアクション名を渡して実行
      $this->runAction($controller, $action, $params);

    } catch (HttpNotFoundException $e) {
      $this->render404Page($e);

    } catch (UnauthorizedActionException $e) {
      list($controller, $action) = $this->login_action;
      $this->runAction($controller, $action);
    }

    $this->response->send();
  }

  //指定されたコントローラのアクションを実行
  public function runAction($controller_name, $action, $params = [])
  {
    $controller_class = ucfirst($controller_name). 'Controller';

    $controller = $this->findController($controller_class);
    if($controller === false) {
      throw new HttpNotFoundException($controller_class. 'controller is not found.');
    }

    $content = $controller->run($action, $params);

    $this->response->setContent($content);
  }

  //コントローラクラス名(xxxControllerなど)を基に対象のコントローラインスタンスを返す
  protected function findController($controller_class)
  {
    //クラスを見つけられない時は指定のコントローラ格納ディレクトリから読み込む
    if(!class_exists($controller_class)) {
      $controller_file = $this->getControllerDir(). '/'. $controller_class. '.php';
      
      if(!is_readable($controller_file)) return false;

      require_once $controller_file;

      if(!class_exists($controller_class)) return false;
    }

    return new $controller_class($this);
  }

  //404エラー画面を返す
  protected function render404Page($e)
  {
    $this->response->setStatusCode(404, 'NotFound');
    $message = $this->isDebugMode() ? $e->getMessage(): 'Page not found';
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    $this->response->setContent(<<<EOF
    <!doctype html>
    <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>404</title>
    </head>
    <body>
        {$message}
    </body>
    </html>
    EOF);
  }
}