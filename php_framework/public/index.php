<?php
require_once '../bootstrap.php';
require_once '../MiniBlogApplication.php';

echo 'sample';

// $session = new Session();
// $session->setAuthenticated(true);
// $session->clear();
// $session->set('name', "pit");
// $session->remove('name');
// var_dump($session->get('name'));
// print("<hr>");

// $req = new Request();
// print("REQUEST_URI: ".$req->getRequestUri());
// print("<hr>");
// print("BaseUrl: ".$req->getBaseUrl());
// print("<hr>");
// print("PathInfo: ".$req->getPathInfo());
// print("<hr>");

// $router = new Router(
//   [
//     '/' => ['controller' => 'home', 'action' => 'index'],
//     '/user/edit' => ['controller' => 'user', 'action' => 'edit'],
//     '/user/:id' => ['controller' => 'user', 'action' => 'show'],
//     '/:controller' => ['action' => 'index'],
//     '/item/:action' => ['controller' => 'item'],
//   ]
// );
// var_dump($router->routes);
// print("<hr>");

// var_dump($router->resolve($req->getPathInfo()));
// print("<hr>");

// $db_manager = new DbManager();
// $db_manager->connect('master', [
//   'dsn' => 'mysql:dbname=homestead;host=172.30.0.4',
//   'user' => 'homestead',
//   'password' => 'secret',
// ]);
// $db_manager->getConnection('master');
// $db_manager->setRepositoryConnectionMap('db', 'master');
// var_dump($db_manager->get('db')->fetchAll('select * from test;'));
// print("<hr>");

$app = new MiniBlogApplication(true);
// $app->run();