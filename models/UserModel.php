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
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function getUserById($userId)
    {
        $userId = $this->db->real_escape_string($userId);
        $query = "SELECT * FROM users WHERE id = $userId";
        $result = $this->db->query($query);

        return $result->fetch_assoc();
    }

    public function getRentalsByUserId($userId)
    {
        $userId = $this->db->real_escape_string($userId);
        $query = "SELECT * FROM rentals WHERE user_id = $userId";

        $result = $this->db->query($query);

        $rentals = [];
        while ($row = $result->fetch_assoc()) {
            $rentals[] = $row;
        }

        return $rentals;
    }

    public function getPaymentMethodsByUserId($userId)
    {
        $userId = $this->db->real_escape_string($userId);
        $query = "SELECT * FROM payment_methods WHERE user_id = $userId";

        $result = $this->db->query($query);

        $paymentMethods = [];
        while ($row = $result->fetch_assoc()) {
            $paymentMethods[] = $row;
        }

        return $paymentMethods;
    }

    public function getUserPaymentMethods($userId)
    {
        $userId = $this->db->real_escape_string($userId);
        $query = "SELECT * FROM payment_methods WHERE user_id = $userId";

        $result = $this->db->query($query);

        $paymentMethods = [];
        while ($row = $result->fetch_assoc()) {
            $paymentMethods[] = $row;
        }

        return $paymentMethods;
    }
    public function createUser($first_name, $last_name, $username, $email, $city_id, $country_id, $password, $profile_picture, $role_id)
    {
        $first_name = $this->db->real_escape_string($first_name);
        $last_name = $this->db->real_escape_string($last_name);
        $username = $this->db->real_escape_string($username);
        $email = $this->db->real_escape_string($email);
        $city_id = $this->db->real_escape_string($city_id);
        $country_id = $this->db->real_escape_string($country_id);
        $password = $this->db->real_escape_string($password);
        $profile_picture = $this->db->real_escape_string($profile_picture);
        $role_id = $this->db->real_escape_string($role_id);

        $stmt = $this->db->prepare("INSERT INTO users (
        first_name = ?,
        last_name = ?,
        username = ?,
        email = ?,
        city_id = ?,
        country_id = ?,
        password = ?,
        profile_picture = ?,
        role_id = ?,
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssiissi", $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $profile_picture, $role_id);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function updateUser($user_id, $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $profile_picture, $role_id)
    {
        $first_name = $this->db->real_escape_string($first_name);
        $last_name = $this->db->real_escape_string($last_name);
        $username = $this->db->real_escape_string($username);
        $email = $this->db->real_escape_string($email);
        $city_id = $this->db->real_escape_string($city_id);
        $country_id = $this->db->real_escape_string($country_id);
        $password = $this->db->real_escape_string($password);
        $profile_picture = $this->db->real_escape_string($profile_picture);
        $role_id = $this->db->real_escape_string($role_id);

        $query = "UPDATE users SET 
        first_name = ?,
        last_name = ?,
        username = ?,
        email = ?,
        city_id = ?,
        country_id = ?,
        password = ?,
        profile_picture = ?,
        role_id = ?,
        WHERE user_id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param("ssssiissii", $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $profile_picture, $role_id, $user_id);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function deleteUser($userId)
    {
        $userId = $this->db->real_escape_string($userId);
        $query = "DELETE FROM users WHERE id = $userId";

        return $this->db->query($query);
    }
}

?>