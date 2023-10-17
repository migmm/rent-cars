<!DOCTYPE html>
<html>

<head>
    <title>Editar Auto de Alquiler</title>
</head>

<body>
    <h1>Editar Auto de Alquiler</h1>
    <form action="index.php?action=update&id=<?php echo $car['car_id']; ?>" method="post">
        <label>Marca:</label>
        <input type="text" name="brand" value="<?php echo $car['brand']; ?>" required><br>

        <label>Pasajeros:</label>
        <input type="number" name="passengers" value="<?php echo $car['passengers']; ?>" required><br>

        <label>Transmisión:</label>
        <input type="text" name="transmission" value="<?php echo $car['transmission']; ?>" required><br>

        <label>Suitcases:</label>
        <input type="number" name="suitcases" value="<?php echo $car['suitcases']; ?>" required><br>

        <label>Categoría:</label>
        <select name="category_id" required>

            <?php
            include('./configs/database.php');
            // Realiza una consulta para obtener todas las categorías desde la tabla car_category
            $query = "SELECT * FROM car_category";
            $result = $connection->query($query);

            if ($result) {
                while ($category = mysqli_fetch_assoc($result)) {
                    $selected = ($category['category_id'] == $car['category_id']) ? 'selected' : '';
                    echo "<option value='{$category['category_id']}' $selected>{$category['NAME']}</option>";
                }
            }
            ?>

        </select><br>

        <label>Aire Acondicionado:</label>
        <input type="checkbox" name="air_conditioner" value="1" <?php if ($car['air_conditioner'] == 1) echo 'checked'; ?>><br>

        <label>Consumo (L/100km):</label>
        <input type="number" step="0.01" name="consumption" value="<?php echo $car['consumption']; ?>" required><br>

        <label>Imagen:</label>
        <input type="text" name="image" value="<?php echo $car['image']; ?>" required><br>

        <input type="submit" value="Actualizar">
    </form>
    <a href="index.php">Volver al Listado</a>
</body>

</html>