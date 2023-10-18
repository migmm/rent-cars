<!DOCTYPE html>
<html>

<head>
    <title>Agregar Nuevo Auto de Alquiler</title>
</head>

<body>
    <h1>Agregar Nuevo Auto de Alquiler</h1>
    <form action="index.php?action=store" method="post">
        <label>Marca:</label>
        <input type="text" name="brand" required><br>

        <label>Modelo:</label>
        <input type="text" name="model" required><br>

        <label>Pasajeros:</label>
        <input type="number" name="passengers" required><br>

        <label>Transmisión:</label>
        <input type="text" name="transmission" required><br>

        <label>Suitcases:</label>
        <input type="number" name="suitcases" required><br>

        <label>Categoría:</label>
        <select name="category_id" required>

            <?php
            include(__DIR__. './configs/database.php');
            // Realiza una consulta para obtener todas las categorías desde la tabla car_category
            $query = "SELECT * FROM car_category";
            $result = $connection->query($query);

            if ($result) {
                while ($category = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$category['category_id']}'>{$category['NAME']}</option>";
                }
            }
            ?>

        </select><br>

        <label>Aire Acondicionado:</label>
        <input type="checkbox" name="air_conditioner" value="1"><br>

        <label>Consumo (L/100km):</label>
        <input type="number" step="0.01" name="consumption" required><br>

        <label>Imagen:</label>
        <input type="text" name="image" required><br>

        <input type="submit" value="Guardar">
    </form>
    <a href="index.php">Volver al Listado</a>
</body>

</html>