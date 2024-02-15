<?php

include(__DIR__ . '/../configs/database.php');
$connection = new Connection();
$model = new UserModel($connection->getConnection());

class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";

        $result = $this->db->query($query);

        $users = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }

        return $users;
    }

    public function getUserById($userId)
    {
        $userId = $this->db->quote($userId);
        $query = "SELECT * FROM users WHERE id = $userId";
        $result = $this->db->query($query);

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($user) {
        $stmt = $this->db->prepare("SELECT id, username, password, role_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
    
        return $stmt->get_result()->fetch_assoc();
    }

    public function getRentalsByUserId($userId)
    {
        $userId = $this->db->quote($userId);
        $query = "SELECT * FROM rentals WHERE user_id = $userId";

        $result = $this->db->query($query);

        $rentals = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = $row;
        }

        return $rentals;
    }

    public function getPaymentMethodsByUserId($userId)
    {
        $userId = $this->db->quote($userId);
        $query = "SELECT * FROM payment_methods WHERE user_id = $userId";

        $result = $this->db->query($query);

        $paymentMethods = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paymentMethods[] = $row;
        }

        return $paymentMethods;
    }

    public function getUserPaymentMethods($userId)
    {
        $userId = $this->db->quote($userId);
        $query = "SELECT * FROM payment_methods WHERE user_id = $userId";

        $result = $this->db->query($query);

        $paymentMethods = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paymentMethods[] = $row;
        }

        return $paymentMethods;
    }
    public function createUser($first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture)
    {
        $query = "INSERT INTO users (
            first_name,
            last_name,
            username,
            email,
            city_id,
            country_id,
            password,
            role_id,
            profile_picture
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
            ?
        )";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param("ssssiisis", $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture);

        return $stmt->execute();
    }

    public function updateUser($id, $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture)
    {
        $query = "UPDATE users SET 
                    first_name = ?,
                    last_name = ?,
                    username = ?,
                    email = ?,
                    city_id = ?,
                    country_id = ?,
                    password = ?,
                    role_id = ?,
                    profile_picture = ?
                    WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param("ssssiisisi", $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture, $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getUserPhotoPath($userId)
    {
        $query = "SELECT profile_picture FROM users WHERE id = ?";
        
        $statement = $this->db->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();

        $result = $statement->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['profile_picture'];
        }

        return null;
    }

    public function deleteUser($userId)
    {
        $userId = $this->db->quote($userId);
        $query = "DELETE FROM users WHERE id = $userId";

        return $this->db->query($query);
    }
}
