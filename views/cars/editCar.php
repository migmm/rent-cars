<?php

include('./configs/database.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit car</title>
</head>

<body>
    <h1>Edit car</h1>
    <form action="cars.php?action=update&id=<?php echo $car['id']; ?>">

        <label>Brand:</label>
        <input type="text" name="brand" value="<?php echo $car['brand']; ?>" required><br>

        <label>Model:</label>
        <input type="text" name="name" value="<?php echo $car['name']; ?>" required><br>

        <label>Year:</label>
        <input type="number" name="year" value="<?php echo $car['year']; ?>" required><br>

        <label>Transmission:</label>
        <input type="text" name="transmission" value="<?php echo $car['transmission']; ?>" required><br>

        <label>Passengers:</label>
        <input type="number" name="passengers" value="<?php echo $car['passengers']; ?>" required><br>

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

        <label>City</label>
        <select name="city_id" id="citySelect" value="<?php echo $car['city_id']; ?>" required>

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

        <label>Category:</label>
        <select name="category_id" value="<?php echo $car['category_id']; ?>" required>

            <?php

            $query = "SELECT * FROM car_categories";
            $result = $connection->query($query);

            if ($result) {
                while ($category = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$category['id']}'>{$category['name']}</option>";
                }
            }

            ?>

        </select><br>

        <label>Air conditioner</label>
        <input type="checkbox" name="air_conditioner" value="<?php echo $car['air_conditioner']; ?>"><br>

        <label>Consumption (L/100km):</label>
        <input type="number" step="0.01" name="consumption" value="<?php echo $car['consumption']; ?>" required><br>

        <label>Owner</label>
        <select name="user_id" value="<?php echo $car['user_id']; ?>" required>

            <?php

            $query = "SELECT * FROM users";
            $result = $connection->query($query);

            if ($result) {
                while ($user = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$user['id']}'>{$user['first_name']} {$user['last_name']}</option>";
                }
            }

            ?>

        </select><br>

        <!--   <label>Rental status</label>
        <label name="rental_id">

            <?php

            $query = "SELECT * FROM rentals";
            $query = "SELECT * FROM rentals WHERE id";
            $result = $connection->query($query);

            if ($result) {
                while ($rental = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$rental['id']}'>{$rental['name']}</option>";
                }
            }

            ?>

        </label><br> -->

        <label>Image:</label>
        <input type="file" name="image" value="<?php echo $car['image']; ?>" required><br>

        <input type="submit" value="Guardar">
    </form>
    <a href="cars.php">Back to list</a>

    <script>

        async function getCities() {
            var countrySelect = document.getElementById("countrySelect");
            var citySelect = document.getElementById("citySelect");

            var selectedCountry = countrySelect.value;

            try {
                var response = await fetch(`utils/getCities.php?country_id=${selectedCountry}`);
                var cities = await response.json();

                citySelect.innerHTML = "";
                for (var i = 0; i < cities.length; i++) {
                    var option = document.createElement("option");
                    option.value = cities[i].id;
                    option.text = cities[i].name;
                    citySelect.add(option);
                }
            } catch (error) {
                console.error("Error al obtener ciudades:", error);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            getCities();
        });

    </script>
</body>

</html>