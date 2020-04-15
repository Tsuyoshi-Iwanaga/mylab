<?php

abstract class DbRepository
{
  protected $con;

  //コンストラクタ
  public function __construct($con)
  {
    $this->setConnection($con);
  }

  //コネクション設定
  public function setConnection($con)
  {
    $this->con = $con;
  }

  //クエリ実行
  public function execute($sql, $params = [])
  {
    $stmt = $this->con->prepare($sql);
    $stmt->execute($params);

    return $stmt;
  }

  //クエリを実行し、結果を1行取得
  public function fetch($sql, $params = [])
  {
    return $this->execute($sql, $params)->fetch(PDO::FETCH_ASSOC);
  }

  //クエリを実行し、結果をすべて取得
  public function fetchAll($sql, $params = [])
  {
    return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  }
}