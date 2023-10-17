<?php

class RentalCarModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllCars()
    {
        $query = "SELECT * FROM rental_cars";
        $result = $this->db->query($query);

        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        return $cars;
    }

    public function getCarById($carId)
    {
        $carId = $this->db->real_escape_string($carId);
        $query = "SELECT * FROM rental_cars WHERE car_id = $carId";
        $result = $this->db->query($query);

        return $result->fetch_assoc();
    }

    public function createCar($brand, $passengers, $transmission, $suitcases, $category_id, $air_conditioner, $consumption, $image)
    {
        $brand = $this->db->real_escape_string($brand);
        $transmission = $this->db->real_escape_string($transmission);
        $image = $this->db->real_escape_string($image);

        $query = "INSERT INTO rental_cars (
            brand, 
            passengers, 
            transmission, 
            suitcases, 
            category_id, 
            air_conditioner, 
            consumption, 
            image
        ) 
        VALUES (
            '$brand', 
            $passengers, 
            '$transmission', 
            $suitcases, 
            $category_id, 
            $air_conditioner, 
            $consumption, '
            $image'
        )";

        return $this->db->query($query);
    }

    public function updateCar($carId, $brand, $passengers, $transmission, $suitcases, $category_id, $air_conditioner, $consumption, $image)
    {
        $carId = $this->db->real_escape_string($carId);
        $brand = $this->db->real_escape_string($brand);
        $transmission = $this->db->real_escape_string($transmission);
        $image = $this->db->real_escape_string($image);

        $query = "UPDATE rental_cars SET 
            brand = '$brand', 
            passengers = $passengers, 
            transmission = '$transmission', 
            suitcases = $suitcases, 
            category_id = $category_id, 
            air_conditioner = $air_conditioner, 
            consumption = $consumption, 
            image = '$image' 
            WHERE car_id = $carId";

        return $this->db->query($query);
    }

    public function deleteCar($carId)
    {
        $carId = $this->db->real_escape_string($carId);
        $query = "DELETE FROM rental_cars WHERE car_id = $carId";

        return $this->db->query($query);
    }
}
