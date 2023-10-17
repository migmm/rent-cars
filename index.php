<?php

include('./configs/database.php');

require_once './models/RentalCarModel.php';
require_once './controllers/RentalCarController.php';
require_once './core/router/Router.php';

$connection = new Connection();
$model = new RentalCarModel($connection->getConnection());
$controller = new RentalCarController($model);
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

$connection->close();

?>