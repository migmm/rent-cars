<?php

include('../configs/database.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>

    <form action="index.php?action=update&id=<?php echo $user['id']; ?>" method="post">

        <label>First name:</label>
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required><br>

        <label>Last name:</label>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required><br>

        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $user['password']; ?>" required><br>

        <label>Country</label>
        <select name="country_id" id="countrySelect" required onchange="getCities()">

            <?php

            $query = "SELECT * FROM countries";
            $result = $connection->query($query);

            if ($result) {
                while ($country = mysqli_fetch_assoc($result)) {
                    $selected = ($country['id'] == $user['country_id']) ? "selected" : "";
                    echo "<option value='{$country['id']}' $selected>{$country['name']}</option>";
                }
            }

            ?>

        </select><br>

        <label>City</label>
        <select name="city_id" id="citySelect" value="<?php echo $user['city_id']; ?>" required>

            <?php

            $query = "SELECT * FROM cities";
            $result = $connection->query($query);

            if ($result) {
                while ($city = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$city['id']}'>{$city['name']}</option>";
                }
            }

            ?>

        </select><br>

        <label>Role:</label>
        <select name="role_id" required>

            <?php

            $query = "SELECT * FROM roles";
            $result = $connection->query($query);

            if ($result) {
                while ($role = mysqli_fetch_assoc($result)) {
                    $selected = ($role['id'] == $user['role_id']) ? "selected" : "";
                    echo "<option value='{$role['id']}' $selected>{$role['role_name']}</option>";
                }
            }

            ?>

        </select><br>

        <label>Profile picture:</label>
        <input type="file" name="profile_picture" required><br>

        <input type="submit" value="Save">
    </form>
    <a href="index.php">Back to list</a>

    <script src="js/main.js"></script>
</body>

</html>