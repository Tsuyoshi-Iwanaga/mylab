<?php

ini_set('display_errors', "On");

//Model
class News {
  private $title;
  private $url;

  public function __construct($title, $url) {
    $this->title = $title;
    $this->url = $url;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getUrl() {
    return $this->url;
  }
}

//Director
class NewsDirector {
  private $builder;
  private $url;

  public function __construct(ArtistsBuilder $builder, $url) {
    $this->builder = $builder;
    $this->url = $url;
  }

  public function getArtists() {
    $news_list = $this->builder->parse($this->url);
    return $news_list;
  }
}

//Builder
interface Builder {
  public function parse($data);
}

//ConcreteBuilder
class ArtistsBuilder implements Builder {

  public function parse($url) {
    $handler = simplexml_load_file($url);

    if($handler === false) {
      throw new Exception('read data failed!');
    }

    $list = array();
    foreach ($handler->artist as $artist) {
      $list[] = new News($artist['name'], $artist->music['name']);
    }

    return $list;
  }
}

//clientCode
$builder = new ArtistsBuilder();
$url = './src/sample01.xml';
$director = new NewsDirector($builder, $url);

foreach($director->getArtists() as $article) {
  print($article->getTitle(). ' → '. $article->getUrl());
  print('<hr>');
}
