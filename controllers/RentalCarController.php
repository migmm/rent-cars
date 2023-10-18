<?php
require_once (__DIR__. '/../models/RentalCarModel.php');
$controller = new RentalCarController($model);

class RentalCarController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $cars = $this->model->getAllCars();
        include 'views/index.php';
    }

    public function create() {
        include 'views/create.php';
    }

    public function store() {
        $brand = $_POST['brand'];
        $passengers = (int)$_POST['passengers'];
        $transmission = $_POST['transmission'];
        $suitcases = (int)$_POST['suitcases'];
        $category_id = (int)$_POST['category_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];
        $image = $_POST['image'];

        $result = $this->model->createCar($brand, $passengers, $transmission, $suitcases, $category_id, $air_conditioner, $consumption, $image);

        if(!$result) {
            die("Query Failed.");
        }
        
        header("Location: index.php");
    }

    public function edit($carId) {
        $car = $this->model->getCarById($carId);

        if(!$car) {
            die("Query Failed.");
        }

        include 'views/edit.php';
    }

    public function update($carId) {
        $brand = $_POST['brand'];
        $passengers = (int)$_POST['passengers'];
        $transmission = $_POST['transmission'];
        $suitcases = (int)$_POST['suitcases'];
        $category_id = (int)$_POST['category_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];
        $image = $_POST['image'];

        $result = $this->model->updateCar($carId, $brand, $passengers, $transmission, $suitcases, $category_id, $air_conditioner, $consumption, $image);

        if(!$result) {
            die("Query Failed.");
        }

        header("Location: index.php");
    }

    public function delete($carId) {
        $result = $this->model->deleteCar($carId);

        if(!$result) {
            die("Query Failed.");
        }

        header("Location: index.php");
    }
}

?>