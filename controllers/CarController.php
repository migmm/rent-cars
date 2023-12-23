<?php

require_once(__DIR__ . '/../models/CarModel.php');
$controller = new RentalCarController($model);

class RentalCarController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $cars = $this->model->getAllCars();
        include 'views/cars/indexCars.php';
    }

    public function createCar()
    {
        include 'views/cars/createCar.php';
    }

    public function storeCar()
    {

        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $year = (int)$_POST['year'];
        $transmission = $_POST['transmission'];
        $passengers = (int)$_POST['passengers'];
        $city_id = (int)$_POST['city_id '];
        $country_id = (int)$_POST['country_id'];
        $rental_id = (int)$_POST['rental_id'];
        $category_id = (int)$_POST['category_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];
        $image = $_POST['image'];

        $result = $this->model->createCar($name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $rental_id, $category_id, $air_conditioner, $consumption, $image);

        if (!$result) {
            die("Query Failed.");
        }

        header("Location: index.php");
    }

    public function editCar($carId)
    {
        $car = $this->model->getCarById($carId);

        if (!$car) {
            die("Query Failed.");
        }

        include 'views/cars/editCar.php';
    }

    public function updateCar($carId)
    {
        $brand = $_POST['brand'];
        $passengers = (int)$_POST['passengers'];
        $transmission = $_POST['transmission'];
        $suitcases = (int)$_POST['suitcases'];
        $category_id = (int)$_POST['category_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];
        $image = $_POST['image'];

        $result = $this->model->updateCar($carId, $brand, $passengers, $transmission, $suitcases, $category_id, $air_conditioner, $consumption, $image);

        if (!$result) {
            die("Query Failed.");
        }

        header("Location: index.php");
    }

    public function deleteCar($carId)
    {
        $result = $this->model->deleteCar($carId);

        if (!$result) {
            die("Query Failed.");
        }

        header("Location: index.php");
    }
}

?>