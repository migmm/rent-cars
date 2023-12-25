<?php

require_once (__DIR__. '/../../controllers/UserController.php');
require_once (__DIR__. './router.php');

$router = new Router($controller);

$router->addRoute('createUser', 'createUser');
$router->addRoute('storeUser', 'storeUser');
$router->addRoute('editUser', 'editUser');
$router->addRoute('updateUser', 'updateUser');
$router->addRoute('deleteUser', 'deleteUser');
$router->addRoute('showUser', 'showUser');
$router->addRoute('confirmDeleteUser', 'confirmDeleteUser');
$router->addRoute('index', 'index');


$router->route();

?>