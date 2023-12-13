<?php

require_once (__DIR__. '/../../controllers/UserController.php');
require_once (__DIR__. './router.php');

$router = new Router($controller);

$router->addRoute('createUser', $controller, 'createUser');
$router->addRoute('storeUser', $controller, 'storeUser');
$router->addRoute('editUser', $controller, 'editUser');
$router->addRoute('updateUser', $controller, 'updateUser');
$router->addRoute('deleteUser', $controller, 'deleteUser');
$router->addRoute('showUser', $controller, 'showUser');
$router->addRoute('confirmDeleteUser', $controller, 'confirmDeleteUser');
$router->addRoute('index', $controller, 'index');

$router->route();

?>