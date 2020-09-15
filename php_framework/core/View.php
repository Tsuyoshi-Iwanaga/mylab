<?php

class View
{
  protected $base_dir;
  protected $defaults;
  protected $layout_variables = [];

  public function __construct($base_dir, $defaults=[])
  {
    $this->base_dir = $base_dir;
    $this->defaults = $defaults;
  }

  public function setLayoutVar($name, $value)
  {
    $this->layout_variables[$name] = $value; 
  }

  public function render($_path, $_variables=[], $_layout=false)
  {
    $_file = $this->base_dir. '/'. $_path. '.php';

    //変数展開
    extract(array_merge($this->defaults, $_variables));

    ob_start();//アウトプットバッファリング開始
    ob_implicit_flush(0);//バッファの自動フラッシュ無効化

    require_once $_file;
    $content = ob_get_clean();//バッファから文字列で取得する

    if($_layout) {
      $content = $this->render(
        $_layout,
        array_merge($this->layout_variables, ['_content' => $content]),
      );
    }
    return $content;
  }

  public function escape($string)
  {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }
}