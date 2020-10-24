<?php
ini_set('display_errors', 'On');

//★ビルダーパターン
//オブジェクトの生成手順と生成手段を分離する。
//利用側(Directorクラス)が利用される側(Builder)の実装を知らなくてもAPIを知っていれば使えるということがポイント

class News {
  private $title;
  private $url;
  private $target_data;

  public function __construct($title, $url, $target_date) {
    $this->title = $title;
    $this->url = $url;
    $this->target_date = $target_date;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getUrl() {
    return $this->url;
  }

  public function getData() {
    return $this->target_date;
  }
}

//Builder
interface NewsBuilder {
  public function parse($url);
}

class RssNewsBuilder implements NewsBuilder {
  public function parse($url) {
  $data = simplexml_load_file($url);
    if($data === false) {
      throw new Exception('reading data is failed!');
    }

    $list = array();

    foreach($data->item as $item) {
      $dc = $item->children('http://purl.org/dc/elements/1.1/');
      $list[] = new News($item->title, $item->link, $dc->date);
    }
    return $list;
  }
}

class NewsDirector {
  private $builder;
  private $url;

  public function __construct(NewsBuilder $builder, $url) {
    $this->builder = $builder;
    $this->url = $url;
  }

  public function getNews() {
    $news_list = $this->builder->parse($this->url);
    return $news_list;
  }
}

//clientCode
$builder = new RssNewsBuilder();
$director = new NewsDirector($builder, 'http://www.php.net/news.rss');

foreach ($director->getNews() as $article) {
  printf('[%s] %s<br>', $article->getData(), $article->getTitle());
}