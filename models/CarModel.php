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
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $cars[] = $row;
        }

        return $cars;
    }

    public function getCarById($carId)
    {
        $carId = $this->db->quote($carId);
        $query = "SELECT * FROM cars WHERE id = $carId";
        $result = $this->db->query($query);

        return $result->fetch(PDO::FETCH_ASSOC);
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
        :name, 
        :brand, 
        :year, 
        :transmission, 
        :passengers, 
        :city_id, 
        :country_id, 
        :rental_id, 
        :category_id, 
        :air_conditioner, 
        :consumption, 
        :user_id 
    )";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':brand', $brand);
        $stmt->bindValue(':year', $year, PDO::PARAM_INT);
        $stmt->bindValue(':transmission', $transmission);
        $stmt->bindValue(':passengers', $passengers, PDO::PARAM_INT);
        $stmt->bindValue(':city_id', $city_id, PDO::PARAM_INT);
        $stmt->bindValue(':country_id', $country_id, PDO::PARAM_INT);
        $stmt->bindValue(':rental_id', $rental_id, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindValue(':air_conditioner', $air_conditioner, PDO::PARAM_BOOL);
        $stmt->bindValue(':consumption', $consumption, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id);

        return $stmt->execute();
    }

    public function updateCar($id, $name, $brand, $year, $transmission, $passengers, $city_id, $country_id, $category_id, $air_conditioner, $consumption, $user_id, $rental_id)
    {
        $query = "UPDATE cars SET 
                name = :name, 
                brand = :brand, 
                year = :year, 
                transmission = :transmission, 
                passengers = :passengers, 
                city_id = :city_id, 
                country_id = :country_id, 
                category_id = :category_id,
                air_conditioner = :air_conditioner, 
                consumption = :consumption, 
                user_id = :user_id, 
                rental_id = :rental_id
                WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':brand', $brand);
        $stmt->bindValue(':year', $year, PDO::PARAM_INT);
        $stmt->bindValue(':transmission', $transmission);
        $stmt->bindValue(':passengers', $passengers, PDO::PARAM_INT);
        $stmt->bindValue(':city_id', $city_id, PDO::PARAM_INT);
        $stmt->bindValue(':country_id', $country_id, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindValue(':air_conditioner', $air_conditioner, PDO::PARAM_BOOL);
        $stmt->bindValue(':consumption', $consumption, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':rental_id', $rental_id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function storeCarImage($carId, $imageName)
{
    $query = "INSERT INTO car_images (car_id, image_name) VALUES (:car_id, :image_name)";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':car_id', $carId, PDO::PARAM_INT);
    $stmt->bindValue(':image_name', $imageName, PDO::PARAM_STR);
    return $stmt->execute();
}

    public function getCarImages($carId)
    {
        $carId = $this->db->quote($carId);
        $query = "SELECT * FROM car_images WHERE car_id = $carId";
        $result = $this->db->query($query);

        $images = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $images[] = $row['image_name'];
        }

        return $images;
    }

    public function deleteCar($carId)
    {
        $carId = $this->db->quote($carId);
        $query = "DELETE FROM cars WHERE id = $carId";

        return $this->db->query($query);
    }
}
