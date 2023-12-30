<?php

require_once(__DIR__ . '/../models/CarModel.php');
$controller = new RentalCarController($model);

class RentalCarController
{
    private $model;
    private $uploadDirectory = "../public/images/";
    private $filenameLength = 10;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $cars = $this->model->getAllCars();
        include '../views/cars/indexCars.php';
    }

    public function createCar()
    {
        include '../views/cars/createCar.php';
    }

    
    public function storeCar()
    {
        $requiredFields = ['name', 'brand', 'year', 'transmission', 'passengers', 'city_id', 'country_id', 'rental_id', 'category_id', 'consumption', 'user_id'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                die("Error: $field is required.");
            }
        }

        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $year = (int)$_POST['year'];
        $transmission = $_POST['transmission'];
        $passengers = (int)$_POST['passengers'];
        $city_id = (int)$_POST['city_id'];
        $country_id = (int)$_POST['country_id'];
        $rental_id = (int)$_POST['rental_id'];
        $category_id = (int)$_POST['category_id'];
        $user_id = $_POST['user_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];

        $imageNames = [];
        $imageNames = [];

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);

            $length = $this->filenameLength;
            $random_name = substr(uniqid('', true), 0, $length) . '.' . $file_extension;
            
            $target_path = $this->uploadDirectory . $random_name;
            move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_path);
            $imageNames[] = $random_name;
        }

        $carId = $this->model->createCar($name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $rental_id, $category_id, $user_id, $air_conditioner, $consumption);

        if ($carId) {
            foreach ($imageNames as $imageName) {
                $this->model->storeCarImage($carId, $imageName);
            }

            //header("Location: view_car.php?id=$carId");
            //exit();
        } else {
            die("Query Failed.");
        }
    }

    public function editCar($carId)
    {
        $car = $this->model->getCarById($carId);

        if (!$car) {
            die("Query Failed.");
        }

        include '../views/cars/editCar.php';
    }


    public function updateCar($carId)
    {
        $requiredFields = ['name', 'brand', 'year', 'transmission', 'passengers', 'city_id', 'country_id', 'category_id', 'consumption', 'user_id'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                die("Error: $field is required.");
            }
        }

        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $year = (int)$_POST['year'];
        $transmission = $_POST['transmission'];
        $passengers = (int)$_POST['passengers'];
        $city_id = (int)$_POST['city_id'];
        $country_id = (int)$_POST['country_id'];
        $rental_id = (int)$_POST['rental_id'];
        $category_id = (int)$_POST['category_id'];
        $user_id = $_POST['user_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];

        $imageNames = [];

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);

            $length = $this->filenameLength;
            $random_name = substr(uniqid('', true), 0, $length) . '.' . $file_extension;

            $target_path = $this->uploadDirectory . $random_name;
            move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_path);
            $imageNames[] = $random_name;
        }

        $result = $this->model->updateCar($carId, $name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $category_id, $air_conditioner, $consumption, $user_id, $rental_id);

        if (!$result) {
            die("Query Failed.");
        }

        foreach ($imageNames as $imageName) {
            $this->model->storeCarImage($carId, $imageName);
        }

        // header("Location: view_car.php?id=$carId");
        // exit();
    }
    

    public function deleteCar($carId)
    {
        $result = $this->model->deleteCar($carId);

        if (!$result) {
            die("Query Failed.");
        }

        header("Location: cars.php");
    }
}
