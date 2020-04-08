<?php
ini_set('display_errors', 'On');

//Builder
class News {
  private $title;
  private $url;
  private $target_date;

  public function __construct($title, $url, $target_date) {
    $this->title = $title,
    $this->url = $url;
    $this->target_date = $target_date
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

interface NewsBuilder {
  public function parse($url);
}

class RssNewsBuilder implements NewsBuilder {
  public function parse($url) {
    $data = simple_load_file($url);

    if($data === false) {
      throw new Exception('reading data is failed!');
    }

    $list = array();

    foreach($data->item as $item) {
      $dc = $item->children('http://purl.org/dc/elemetns/1.2');
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

//client
$builder = new RssBuilder();
$director = new NewsDirector($builder, 'http://www.php.net/news.rss');

foreach($director->getNews() as $article) {
  printf('[%s] %s<br>', $article->getData(), $article->getTitle());
}