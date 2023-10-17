<!DOCTYPE html>
<html>

<head>
    <title>Listado de Autos de Alquiler</title>
</head>

<body>
    <h1>Listado de Autos de Alquiler</h1>
    <a href="index.php?action=create">Agregar Nuevo Auto</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Transmission</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($cars as $car) : ?>
            <tr>
                <td><?php echo $car['car_id']; ?></td>
                <td><?php echo $car['brand']; ?></td>
                <td><?php echo $car['transmission']; ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?php echo $car['car_id']; ?>">Editar</a>
                    <a href="index.php?action=delete&id=<?php echo $car['car_id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>