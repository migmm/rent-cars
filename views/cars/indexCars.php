<!DOCTYPE html>
<html>

<head>
    <title>Car list</title>
</head>

<body>
    <h1>Rent car list</h1>
    <a href="cars.php?action=createCar">Add new car</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Model</th>
            <th>Brand</th>
            <th>year</th>
            <th>Transmission</th>
            <th>Passengers</th>
            <th>City</th>
            <th>Country</th>
            <th>Rented at</th>
            <th>Category</th>
            <th>Air conditioner</th>
            <th>Consumption</th>
            <th>Owner</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($cars as $car) : ?>
            <tr>
                <td><?php echo $car['id']; ?></td>
                <td><?php echo $car['name']; ?></td>
                <td><?php echo $car['brand']; ?></td>
                <td><?php echo $car['year']; ?></td>
                <td><?php echo $car['transmission']; ?></td>
                <td><?php echo $car['passengers']; ?></td>
                <td><?php echo $car['city_id']; ?></td>
                <td><?php echo $car['country_id']; ?></td>
                <td><?php echo $car['rental_id']; ?></td>
                <td><?php echo $car['category_id']; ?></td>
                <td><?php echo $car['air_conditioner']; ?></td>
                <td><?php echo $car['consumption']; ?></td>
                <td><?php echo $car['user_id']; ?></td>
                <td>
                    <?php foreach ($car['images'] as $image) : ?>
                        <img src="../public/images/<?php echo $image; ?>" alt="Car Image">
                    <?php endforeach; ?>
                </td>
                <td>
                    <a href="cars.php?action=editCar&id=<?php echo $car['id']; ?>">Edit</a>
                    <a href="cars.php?action=deleteCar&id=<?php echo $car['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
