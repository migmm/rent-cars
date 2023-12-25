<?php

require_once (__DIR__. '/../../controllers/AuthController.php');
require_once (__DIR__. './Router.php');

$router = new Router($controller);

$router->addRoute('register', 'register');
$router->addRoute('login', 'login');
$router->addRoute('index', 'index');

$router->route();

?>