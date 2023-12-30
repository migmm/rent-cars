<?php

$brand = '';
$name = '';
$year = '';
$transmission = '';
$passengers = '';
$air_conditioner = '';
$consumption = '';
$user_id = '';
$image = '';
$rental_id = '';

if ($car) {
    $brand = $car['brand'];
    $name = $car['name'];
    $year = $car['year'];
    $transmission = $car['transmission'];
    $passengers = $car['passengers'];
    $air_conditioner = $car['air_conditioner'];
    $consumption = $car['consumption'];
    $user_id = $car['user_id'];
    $rental_id = $car['rental_id'];
    $image = $car['image'];
}

?>
<label>Brand:</label>
<input type="text" name="brand" value="<?php echo $brand; ?>" required><br>

<label>Model:</label>
<input type="text" name="name" value="<?php echo $name; ?>" required><br>

<label>Year:</label>
<input type="number" name="year" value="<?php echo $year; ?>" required><br>

<label>Transmission:</label>
<input type="text" name="transmission" value="<?php echo $transmission; ?>" required><br>

<label>Passengers:</label>
<input type="number" name="passengers" value="<?php echo $passengers; ?>" required><br>

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

<label>Country</label>
<select name="country_id" id="countrySelect" required onchange="getCities()">

    <?php

    $query = "SELECT * FROM countries";
    $result = $connection->query($query);

    if ($result) {
        while ($country = mysqli_fetch_assoc($result)) {
            $selected = ($country['id'] == $car['country_id']) ? "selected" : "";
            echo "<option value='{$country['id']}' $selected>{$country['name']}</option>";
        }
    }

    ?>

</select><br>

<label>Category:</label>
<select name="category_id" required>

    <?php

    $query = "SELECT * FROM car_categories";
    $result = $connection->query($query);

    if ($result) {
        while ($category = mysqli_fetch_assoc($result)) {
            $selected = ($category['id'] == $car['category_id']) ? "selected" : "";
            echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
        }
    }

    ?>

</select><br>

<label>Air conditioner</label>
<input type="checkbox" name="air_conditioner" value="<?php echo $air_conditioner; ?>"><br>

<label>Consumption (L/100km):</label>
<input type="number" step="0.01" name="consumption" value="<?php echo $consumption; ?>" required><br>

<label>Owner</label>
<select name="user_id" required>

    <?php

    $query = "SELECT * FROM users";
    $result = $connection->query($query);

    if ($result) {
        while ($user = mysqli_fetch_assoc($result)) {
            $selected = ($user['id'] == $car['user_id']) ? "selected" : "";
            echo "<option value='{$user['id']}'$selected>{$user['first_name']} {$user['last_name']}</option>";
        }
    }

    ?>

</select><br>

<label>Rental ID:</label>
<input type="number" name="rental_id" value="<?php echo $rental_id; ?>" required><br>


<!-- 
  <label>Rental status</label>
        <label name="rental_id">
 -->
<?php

/*       $query = "SELECT * FROM rentals";
            $query = "SELECT * FROM rentals WHERE id";
            $result = $connection->query($query);

            if ($result) {
                while ($rental = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$rental['id']}'>{$rental['name']}</option>";
                }
            } */

?>
<!-- 
        </label><br> -->

<label>Image:</label>
<input type="file" name="images[]" multiple accept="image/*"><br>


<input type="submit" value="Save">