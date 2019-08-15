<?php

class Loader {
  public static function getPageInstance() {

    //リクエストされたURLのファイル部分のみを取得
    $pathArray = explode('/', $_SERVER['SCRIPT_NAME']);
    $lastIndex = count($pathArray) - 1;
    $pageName = str_replace('.php', '', $pathArray[$lastIndex]);

    //クラスファイルの存在確認
    $className = $pageName . 'Page';
    $classPath = realpath(sprintf('%s/../pages/%s.php', __DIR__, $className));
    if (false == file_exists($classPath)) {
      throw new Exception('クラスファイルが存在しません');
    }

    //クラスファイル読み込み
    require_once $classPath;

    //クラスの定義確認
    if(class_exists($className) == false) {
      throw new Exception('クラスが定義されていません');
    }

    $instance = new $className();
    return $instance;
  }
}
?>