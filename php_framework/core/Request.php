<?php

class Request
{
  //POSTかどうか
  public function inPost()
  {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      return true;
    }
    return false;
  }

  //GETパラメータを取得する
  public function getGet($name, $default = null)
  {
    if(isset($_GET[$name])) {
      return $_GET[$name];
    }
    return $default;
  }

  //POSTパラメータを取得する
  public function getPost($name, $default = null)
  {
    if(isset($_POST[$name])) {
      return $_POST[$name];
    }
    return $default;
  }

  //ホスト名を取得
  public function getHost()
  {
    if(!empty($_SERVER['HTTP_HOST'])) {
      return $_SERVER['HTTP_HOST'];
    }

    return $_SERVER['SERVER_NAME'];
  }

  //SSLでのアクセスかどうか
  public function isSsl()
  {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
      return true;
    }
    return false;
  }

  //リクエストURIを取得
  public function getRequestUri()
  {
    return $_SERVER['REQUEST_URI'];
  }

  //ベースURLを取得(フロントコントローラまでのパス)
  public function getBaseUrl()
  {
    $script_name = $_SERVER['SCRIPT_NAME'];
    $request_uri = $this->getRequestUri();

    if(strpos($request_uri, $script_name) === 0) {
      // ①aaa/index.php/hoge → aaa/index.php
      return $script_name;

    } else if (strpos($request_uri, dirname($script_name)) === 0) {
      // ②aaa/bbb/hoge → rtrim(dirname(aaa/index.php), '/')つまりaaa
      return rtrim(dirname($script_name), '/')
    }

    return '';
  }

  //PATH_INFOを取得()
  public function getPathInfo()
  {
    $base_url = $this->getBaseUrl(); // ''や'/aaa'
    $request_uri = $this->getRequestUri();// '/xxx'や'/aaa/xxx/yyy?a=b'など

    //?クエリが付いていたら削除する
    if(($pos = strpos($request_uri, '?')) !== false) {
      $request_uri = substr($request_uri, 0, $pos);
    }

    $path_info = (string)substr($request_uri, strlen($base_url));
    return $path_info;
  }
}