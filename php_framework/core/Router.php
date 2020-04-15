<?php

class Router
{
  protected $routes;

  //コンストラクタ
  public function __construct($definitions)
  {
    $this->routes = $this->compileRoutes($definitions);
  }

  //$definitions例 ['/aaa/bbb' => ['controller' => 'status', 'action' => 'index']]
  public function compileRoutes($definitions)
  {
    $routes = [];

    foreach($definitions as $url => $param) {

      // $urlが/aaa/:bbbなら、$tokenには["aaa", ":bbb"]などが格納される
      $tokens = explode('/', ltrim($url, '/'));

      foreach ($tokens as $i => $token) {
        // :bbbといった動的パラメータの時は(?P<bbb>[^/]+)の形に変換する
        if(strpos($token, ':') === 0) {
          $name = substr($token, 1);
          $token = '(?P<'. $name. '>[^/]+)';
        }
        // ["aaa", "(?P<bbb>[^/]+)"]
        $token[$i] = $token;
      }

      // aaa/(?P<bbb>[^/]+)などが格納される
      $pattern = '/'. implode('/', $tokens);

      $routes[$pattern] = $params;
    }

    //結果として下記のような変換されたテーブルが返される
    //['aaa/(?P<bbb>[^/]+)' => ['controller' => 'status', 'action' => 'index']]
    return $routes;
  }

  // 指定されたPATH_INFO(/aaa/bbbなど)を元に、ルーティングパラメータを引き当てる
  //
  public function resolve($path_info)
  {
    // 先頭が'/'で始まっていない場合はつける
    if(substr($path_info, 0, 1) === '/') {
      $path_info = '/'. $path_info;
    }

    // $patternがaaa/bbbなら$path_infoがaaa/bbbにだけマッチする
    // $patternがaaa/(?P<bbb>[^/]+)なら$path_infoがaaa/bbbやaaa/cccなどにマッチする
    // 複数マッチするものがあれば一番先に処理されたものが採用される
    foreach($this->routes as $pattern => $params) {

      // $params ['controller' => 'status', 'action' => 'index']
      // $matches ['0' => 'hoge', 'bbb' => 'hoge'] ※/aaa/:bbbに対し/aaa/hoge
      // マージされると['controller' => 'status', 'action' => 'index', '0' => 'hoge', 'bbb' => 'hoge']みたいになり、これが返される。
      if(preg_match('#^'. $pattern. '$#', $path_info, $matches)) {
        $params = array_merge($param, $matches);
        return $params;
      }
    }

    return false;
  }
}