<?php

session_start();

require_once(__DIR__ . '/../models/UserModel.php');
$controller = new AuthController($model);

class AuthController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        include '../views/auth/indexAuth.php';
    }

    public function login() {
        include '../views/auth/login.php';
    }

    public function register() {
        include '../views/auth/register.php';
    }
}

?>
