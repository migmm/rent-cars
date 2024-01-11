# RENTAL CARS

A portal for car rent builded in vanilla PHP, HTML, CSS and Javascript with MySQL Database. Using MVC pattern with POO.

<p align="center">
  <img src="https://github.com/migmm/rent-cars/blob/images/cars-logo.png" alt="Logo"/>
</p>

## Features

### Database

Possibility to switch between MySQL or PostgreSQL database, changing only one line in `config/database.php` file.

Sample SQL data and tables files are provided.

### Routing

Used routing with a function and a file for every route group.

### Security

#### Queries protected with stmt in model and controller

```php
public function createUser($first_name, $last_name, $username, $email, $city_id, $country_id, $password, $profile_picture, $role_id) {
    $this->db->prepare("INSERT INTO users (first_name, last_name, username, email, city_id, country_id, password, role_id, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt = $this->db->prepare($query);
    $stmt->execute([$first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture]);
}
```

```php
public function createUser($first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture)
    {
        $query = "INSERT INTO users ( first_name, last_name, username, email, city_id, country_id, password, role_id, profile_picture ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ? )";

        $stmt = $this->db->prepare($query);

        $stmt->bind_param("ssssiisis", $first_name, $last_name, $username, $email, $city_id, $country_id, $password, $role_id, $profile_picture);

        return $stmt->execute();
    }
```

This query inserts a new user into the `users` table with the specified parameters using parameterized prepared statements to prevent SQL injection attacks.

#### Passsword stroring

Passwords encrypted with ARGON2 algorithm.

#### Cookies and JWT token

JWT tokens are used in order to stay logged in, and as an extra the token is encrypted before storing in cookies.
Cookies used are HTTP and secure server.

#### .htaccess and friendly urls

Configured .htaccess file for protect routing urls in `public` directory and limit access to forbidden files. also are configured friendly urls.

### Files

Possibility to limit the number of files, limit the size and resize to a specific resolution.
