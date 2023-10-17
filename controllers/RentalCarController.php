<?php

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
        // Validar y obtener los datos del formulario
        $brand = $_POST['brand'];
        $passengers = (int)$_POST['passengers'];
        $transmission = $_POST['transmission'];
        $suitcases = (int)$_POST['suitcases'];
        $category_id = (int)$_POST['category_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];
        $image = $_POST['image'];

        // Llamar al modelo para crear un nuevo auto
        $result = $this->model->createCar($brand, $passengers, $transmission, $suitcases, $category_id, $air_conditioner, $consumption, $image);

        if(!$result) {
            die("Query Failed.");
        }
        
        // Redirigir a la lista de autos
        header("Location: index.php");
    }

    public function edit($carId) {
        // Obtener los datos del auto por su ID
        $car = $this->model->getCarById($carId);

        if(!$car) {
            die("Query Failed.");
        }

        // Mostrar el formulario de edición con los datos del auto
        include 'views/edit.php';
    }

    public function update($carId) {
        // Validar y obtener los datos del formulario
        $brand = $_POST['brand'];
        $passengers = (int)$_POST['passengers'];
        $transmission = $_POST['transmission'];
        $suitcases = (int)$_POST['suitcases'];
        $category_id = (int)$_POST['category_id'];
        $air_conditioner = isset($_POST['air_conditioner']) ? 1 : 0;
        $consumption = (float)$_POST['consumption'];
        $image = $_POST['image'];

        // Llamar al modelo para actualizar el auto
        $result = $this->model->updateCar($carId, $brand, $passengers, $transmission, $suitcases, $category_id, $air_conditioner, $consumption, $image);

        if(!$result) {
            die("Query Failed.");
        }

        // Redirigir a la lista de autos
        header("Location: index.php");
    }

    public function delete($carId) {
        // Llamar al modelo para eliminar el auto por su ID
        $result = $this->model->deleteCar($carId);

        if(!$result) {
            die("Query Failed.");
        }

        // Redirigir a la lista de autos
        header("Location: index.php");
    }
}

?>