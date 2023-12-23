<?php

include('../configs/database.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>New user</title>
</head>

<body>
    <h1>New user</h1>
    <form action="index.php?action=store" method="post">
        <label>First name:</label>
        <input type="text" name="first_name" required><br>

        <label>Last name:</label>
        <input type="text" name="last_name" required><br>

        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Email:</label>
        <input type="text" name="email" required><br>

        <label>Password:</label>
        <input type="text" name="password" required><br>

        <label>Country</label>
        <select name="country_id" id="countrySelect" required onchange="getCities()">

            <?php

            $query = "SELECT * FROM countries";
            $result = $connection->query($query);

            if ($result) {
                while ($country = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$country['id']}'>{$country['name']}</option>";
                }
            }

            ?>

        </select><br>

        <label>City</label>
        <select name="city_id" id="citySelect" required>

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
                    echo "<option value='{$role['id']}'>{$role['role_name']}</option>";
                }
            }

            ?>

        </select><br>

        <label>Profile picture:</label>
        <input type="text" name="profile_picture" required><br>

        <input type="submit" value="Save">
    </form>
    <a href="users.php">Back to list</a>

    <script src="js/main.js"></script>
</body>

</html>