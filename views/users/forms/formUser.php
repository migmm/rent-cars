<?php

$first_name = '';
$last_name = '';
$username = '';
$email = '';
$password = '';
$profile_picture = '';

if ($user) {
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $username = $user['username'];
    $email = $user['email'];
    $password = $user['password'];
    $profile_picture = $user['profile_picture'];
}

?>
<label>First name:</label>
<input type="text" name="first_name" value="<?php echo $first_name; ?>" required><br>

<label>Last name:</label>
<input type="text" name="last_name" value="<?php echo $last_name; ?>" required><br>

<label>Username:</label>
<input type="text" name="username" value="<?php echo $username; ?>" required><br>

<label>Email:</label>
<input type="text" name="email" value="<?php echo $email; ?>" required><br>

<label>Password:</label>
<input type="text" name="password" value="<?php echo $password; ?>" required><br>

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
            $selected = ($role['id'] == $user['role_id']) ? "selected" : "";
            echo "<option value='{$role['id']}' $selected>{$role['role_name']}</option>";
        }
    }

    ?>

</select><br>

<label>Profile picture:</label>
<input type="file" name="profile_picture" value="<?php echo $profile_picture; ?>" required><br>

<input type="submit" value="Save">