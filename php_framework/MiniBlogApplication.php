<?php

class MiniBlogApplication extends Application
{
  protected $login_action = ['account', 'signin'];

  public function getRootDir()
  {
    return dirname(__FILE__);
  }

  protected function registerRoutes()
  {
    return [
      //status
      '/' => ['controller' => 'status', 'action' => 'index'],
      '/status/post' => ['controller' => 'status', 'action' => 'post'],
      '/user/:user_name' => ['controller' => 'status', 'action' => 'user'],
      '/user/:user_name/status/:id' => ['controller' => 'status', 'action' => 'show'],
      //account
      '/account' => ['controller' => 'account', 'action' => 'index'],
      '/account/:action' => ['controller' => 'account'],
      '/follow' => ['controller' => 'account', 'action' => 'follow'],
    ];
  }

  protected function configure()
  {
    $this->db_manager->connect('master',[
      'dsn' => 'mysql:dbname=homestead;host=172.30.0.4',
      'user' => 'homestead',
      'password' => 'secret',
    ]);
  }
}