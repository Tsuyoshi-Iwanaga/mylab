<?php

class ClassLoader
{
  protected $dirs;

  //自身をAutoloadスタックに登録
  public function register()
  {
    spl_autoload_register([$this, 'loadClass']);
  }

  //Autoload対象となるディレクトリを登録
  public function registerDir($dir)
  {
    $this->dirs[] = $dir;
  }

  //クラスの読み込み処理
  public function loadClass($class)
  {
    foreach($this->dirs as $dir) {
      $file = $dir. '/'. $class. '.php';
      if(is_readable($file)) {
        require_once $file;
        return;
      }
    }
  }
}