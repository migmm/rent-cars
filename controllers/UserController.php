<?php

require_once(__DIR__ . '/../models/UserModel.php');
$controller = new UserController($model);

class UserController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $users = $this->model->getAllUsers();

        foreach ($users as &$user) {
            $user['rentals'] = $this->model->getRentalsByUserId($user['id']);
            $user['paymentMethods'] = $this->model->getPaymentMethodsByUserId($user['id']);
        }

        include '../views/users/indexUsers.php';
    }

    public function createUser()
    {
        include '../views/users/createUser.php';
    }

    public function storeUser()
    {
        $requiredFields = ['first_name', 'last_name', 'username', 'email', 'password', 'role_id', 'city_id', 'country_id'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                die("Error: $field is required.");
            }
        }

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $city_id = (int)$_POST['city_id'];
        $country_id = (int)$_POST['country_id'];
        $password = $_POST['password'];
        $role_id = (int)$_POST['role_id'];
        $profile_picture = $_POST['profile_picture'];

        echo "<pre>";
        echo "POST Data:\n";
        var_dump($_POST);
        echo "</pre>";

        $result = $this->model->createUser($first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture);

        echo $result;

        if (!$result) {
            die("Query Failed.");
        }

       /*  header("Location: ../public/index.php"); */
    }

    public function editUser($userId)
    {
        $user = $this->model->getUserById($userId);

        if (!$user) {
            die("User not found.");
        }

        include '../views/users/editUser.php';
    }

    public function updateUser($userId)
    {
        $requiredFields = ['first_name', 'last_name', 'username', 'email', 'password', 'role_id', 'city_id', 'country_id'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                die("Error: $field is required.");
            }
        }

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $city_id = $_POST['$city_id'];
        $country_id = $_POST['$country_id'];
        $password = $_POST['password'];
        $role_id = $_POST['role_id'];
        $profile_picture = $_POST['profile_picture'];

        echo "<pre>";
        echo "POST Data:\n";
        var_dump($_POST);
        echo "</pre>";

        $result = $this->model->updateUser($userId, $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture);

        echo $result;

        if (!$result) {
            die("Query Failed.");
        }

      /*   header("Location: ../public/index.php"); */
    }

    public function deleteUser($userId)
    {

        $result = $this->model->deleteUser($userId);

        if (!$result) {
            die("Query Failed.");
        }

       /*  header("Location: ../public/index.php"); */
    }
}
