<?php

require_once (__DIR__. '/../../controllers/CarController.php');
require_once (__DIR__. './Router.php');

$router = new Router($controller);

$router->addRoute('createCar', $controller, 'createCar');
$router->addRoute('storeCar', $controller, 'storeCar');
$router->addRoute('editCar', $controller, 'editCar');
$router->addRoute('updateCar', $controller, 'updateCar');
$router->addRoute('deleteCar', $controller, 'deleteCar');
$router->addRoute('showCar', $controller, 'showCar');
$router->addRoute('confirmDeleteCar', $controller, 'confirmDeleteCar');
$router->addRoute('index', $controller, 'index');

$router->route();

?>