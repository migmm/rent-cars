<?php

include(__DIR__ . '/../configs/database.php');
$connection = new Connection();
$model = new RentalCarModel($connection->getConnection());

class RentalCarModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllCars()
    {
        $query = "SELECT * FROM cars";
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
        $query = "SELECT * FROM cars WHERE id = $carId";
        $result = $this->db->query($query);

        return $result->fetch_assoc();
    }

    public function createCar($name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $rental_id, $category_id, $air_conditioner, $consumption, $user_id)
    {
        $query = "INSERT INTO cars (
            name, 
            brand, 
            year, 
            transmission, 
            passengers, 
            city_id, 
            country_id, 
            rental_id,
            category_id,
            air_conditioner, 
            consumption, 
            user_id 
    ) 
    VALUES (
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?
    )";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssisiiiiidii', $name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $rental_id, $category_id, $air_conditioner, $consumption, $user_id);

        return $stmt->execute();
    }

    public function updateCar($id, $name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $category_id, $air_conditioner, $consumption, $user_id, $rental_id)
    {
        $query = "UPDATE cars SET 
                    name = ?, 
                    brand = ?, 
                    year = ?, 
                    transmission = ?, 
                    passengers = ?, 
                    city_id = ?, 
                    country_id = ?, 
                    category_id = ?,
                    air_conditioner = ?, 
                    consumption = ?, 
                    user_id = ?, 
                    rental_id = ?
                    WHERE id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssisiiiiidiii', $name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $category_id, $air_conditioner, $consumption, $user_id, $rental_id, $id);

        return $stmt->execute();
    }

    public function storeCarImage($carId, $imageName)
    {
        $query = "INSERT INTO car_images (car_id, image_name) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $carId, $imageName);
        return $stmt->execute();
    }

    public function getCarImages($carId)
    {
        $carId = $this->db->real_escape_string($carId);
        $query = "SELECT * FROM car_images WHERE car_id = $carId";
        $result = $this->db->query($query);
    
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image_name'];
        }
    
        return $images;
    }

    public function deleteCar($carId)
    {
        $carId = $this->db->real_escape_string($carId);
        $query = "DELETE FROM cars WHERE id = $carId";

        return $this->db->query($query);
    }
}

?>