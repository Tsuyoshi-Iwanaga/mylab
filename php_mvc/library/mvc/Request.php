<?php
require_once('Post.php');
require_once('QueryStrings.php');

class Request {
  private $post;
  private $get;

  public function __construct() {
    $this->post = new Post();
    $this->get = new QueryString();
  }

  public function getPost($key = null) {
    return $this->post->get($key);
  }

  public function getQuery($key = null) {
    return $this->get->get($key);
  }
}
?>