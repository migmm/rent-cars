<?php

require_once (__DIR__. '/../../controllers/RentalCarController.php');
require_once (__DIR__. './Router.php');

$router = new Router($controller);

$router->addRoute('create', $controller, 'create');
$router->addRoute('store', $controller, 'store');
$router->addRoute('edit', $controller, 'edit');
$router->addRoute('update', $controller, 'update');
$router->addRoute('delete', $controller, 'delete');
$router->addRoute('show', $controller, 'show');
$router->addRoute('confirmDelete', $controller, 'confirmDelete');
$router->addRoute('index', $controller, 'index');

$router->route();

?>