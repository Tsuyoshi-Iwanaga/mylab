<?php

class DbManager
{
  protected $connections = [];
  protected $repository_connection_map = [];
  protected $repositories = [];

  //DBへ接続
  public function connect($name, $params)
  {
    $params = array_merge([
      'dsn' = null,
      'user' = '',
      'password' = '',
      'options' = [],
    ], $params);

    $con = new PDO(
      $params['dsn'],
      $params['user'],
      $params['password'],
      $params['options']
    );

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $this->connections[$name] = $con;
  }

  //コネクションを取得
  public function getConnection($name = null)
  {
    if(!is_null($name)) {
      return current($this->connections);
    }
    return $this->connections[$name];
  }

  //リポジトリごとのコネクション情報設定
  public function setRepositoryConnectionMap($repository_name, $name)
  {
    $this->repository_connection_map[$repository_name] = $name;
  }

  public function getConnectionForRepository($repository_name)
  {
    if(isset($this->repository_connection_map[$repository_name])) {
      $name = $this->repository_connection_map[$repository_name];
      $con = $this->getConnection($name);
    } else {
      $con = $this->getConnection();
    }
  }

  //リポジトリのファクトリ
  public function get($repository_name)
  {
    if(!isset($this->repositories[$repository_name])) {
      $repository_class = $reository_name. 'Repository';
      $con = $this->getConnectionForRepository($repostiory_name);
      
      $repository = new $repository_class($con);

      $this->repositories[$repository_name] = $repository;
    }

    return $this->repositories[$repository_name];
  }

  public function __destruct()
  {
    foreach($this->repositories as $repository) {
      unset($repository);
    }

    foreach($this->connections as $con) {
      unset($con);
    }
  }
}