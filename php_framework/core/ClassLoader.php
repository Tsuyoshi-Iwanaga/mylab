<?php

class ClassLoader
{
  public $dirs;

  public function register()
  {
    spl_autoload_register([$this, 'loadClass']);
  }

  public function registerDir($dir)
  {
    $this->dirs[] = $dir;
  }

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
