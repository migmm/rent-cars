<?php

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

    public function login()
    {
        if (isset($_SESSION['username'])) {
            echo "Session: ";
            foreach ($_SESSION as $key => $value) {
                echo "{$key}: {$value}\n";
            }
        } else {
            include '../views/auth/login.php';
        }
    }

    public function signin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $foundUser = $this->model->getUserByUsername($username);

        if (!$foundUser) {
            die("Invalid login credentials");
        }

        if (!password_verify($password, $foundUser['password'])) {
            die("Invalid login credentials");
        }

        $_SESSION['username'] = $foundUser['username'];
        $_SESSION['role'] = $foundUser['role_id'];
        $_SESSION['password'] = $foundUser['password'];

        echo "User exist. Username: {$foundUser['username']}. Role: {$foundUser['role_id']}. Password: {$foundUser['password']}";

        print_r($foundUser);
    }

    public function logout()
    {
        session_destroy();
        header("Location: ../public/auth.php");
    }

    public function register()
    {
        include '../views/auth/register.php';
    }
}
