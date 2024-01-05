<?php

require_once(__DIR__ . '/../models/UserModel.php');
require_once(__DIR__ . '/../utils/jwtToken.php');

$controller = new AuthController($model, $secretKey, $encryptionKey);


class AuthController
{
    private $model;
    private $secretKey;
    private $encryptionKey;

    public function __construct($model, $secretKey, $encryptionKey)
    {
        $this->model = $model;
        $this->secretKey = $secretKey;
        $this->encryptionKey = $encryptionKey;
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
        $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $rememberMe = isset($_POST['rememberme']) ? $_POST['rememberme'] : '';

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

        $userData = array(
            'id' => $foundUser['id'],
            'username' => $foundUser['username'],
            'role' => $foundUser['role_id'],
        );

        if ($rememberMe) {
            generateAndSetCookie(
                $userData,
                $this->secretKey,
                $this->encryptionKey
            );
        }

        echo "User exist. Username: {$foundUser['username']}. Role: {$foundUser['role_id']}. Password: {$foundUser['password']}";

        print_r($foundUser);
    }

    public function logout()
    {
        session_destroy();
        clean_cookie();
        header("Location: auth.php");
    }

    public function register()
    {
        include '../views/auth/register.php';
    }
}

?>