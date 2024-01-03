<?php

require_once(__DIR__ . '/../models/UserModel.php');
require_once(__DIR__ . '/../utils/jwtToken.php');

$controller = new UserController($model, $secretKey, $encryptionKey);

class UserController
{
    private $model;
    private $uploadDirectory = "../public/images/";
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
        $password = password_hash($_POST['password'], PASSWORD_ARGON2_DEFAULT_THREADS);
        $role_id = (int)$_POST['role_id'];

        if (!empty($_FILES['profile_picture']['tmp_name'])) {
            $originalImagePath = $_FILES['profile_picture']['tmp_name'];

            $uniqueFilename = uniqid('profile_', true);
            $uploadDirectory = $this->uploadDirectory;
            $resizedImagePath = $uploadDirectory . $uniqueFilename . '.jpg';

            $targetPath = $uploadDirectory . $uniqueFilename . '.jpg';
            move_uploaded_file($originalImagePath, $targetPath);
            $this->resizeAndSaveImage($targetPath, $resizedImagePath, 300, 200);

            $profile_picture = $resizedImagePath;
        } else {
            $profile_picture = null;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Error: Invalid email format.");
        }

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
        $city_id = (int)$_POST['city_id'];
        $country_id = (int)$_POST['country_id'];
        $password = $_POST['password'];
        $role_id = (int)$_POST['role_id'];

        $currentPhotoPath = $this->model->getUserPhotoPath($userId);

        if (!empty($_FILES['profile_picture']['tmp_name'])) {
            $originalImagePath = $_FILES['profile_picture']['tmp_name'];

            $uniqueFilename = uniqid('profile_', true);
            $uploadDirectory = $this->uploadDirectory;
            $resizedImagePath = $uploadDirectory . $uniqueFilename . '.jpg';

            $targetPath = $uploadDirectory . $uniqueFilename . '.jpg';
            move_uploaded_file($originalImagePath, $targetPath);
            $this->resizeAndSaveImage($targetPath, $resizedImagePath, 300, 200);

            $profile_picture = $resizedImagePath;
        } else {
            $profile_picture = null;
        }

        if ($currentPhotoPath && file_exists($currentPhotoPath)) {
            unlink($currentPhotoPath);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Error: Invalid email format.");
        }

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

    function resizeAndSaveImage($sourcePath, $targetPath, $newWidth, $newHeight)
    {
        list($originalWidth, $originalHeight) = getimagesize($sourcePath);

        $ratio = $originalWidth / $originalHeight;
        if ($newWidth / $newHeight > $ratio) {
            $newWidth = $newHeight * $ratio;
        } else {
            $newHeight = $newWidth / $ratio;
        }

        $sourceImage = imagecreatefromjpeg($sourcePath);
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled(
            $resizedImage,
            $sourceImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );

        imagejpeg($resizedImage, $targetPath);

        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
    }

    public function deleteUser($userId)
    {

        $result = $this->model->deleteUser($userId);

        if (!$result) {
            die("Query Failed.");
        }

        header("Location: users.php");
    }
}

?>