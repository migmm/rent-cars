<?php

require_once (__DIR__. '/../../controllers/CarController.php');
require_once (__DIR__. './Router.php');

$router = new Router($controller);


$router->addRoute('createCar', 'createCar');
$router->addRoute('storeCar', 'storeCar');
$router->addRoute('editCar', 'editCar');
$router->addRoute('updateCar', 'updateCar');
$router->addRoute('deleteCar', 'deleteCar');
$router->addRoute('showCar', 'showCar');
$router->addRoute('confirmDeleteCar', 'confirmDeleteCar');
$router->addRoute('index', 'index');

$router->route();

?>