<?php

include('../configs/database.php');
$car = null;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add new car</title>
</head>

<body>
    <h1>Add new car</h1>
    <form action="cars.php?action=storeCar" method="post" enctype="multipart/form-data">

        <?php

        include('forms/formCar.php');

        ?>

    </form>
    <a href="cars.php">Back to list</a>

    <script src="js/main.js"></script>
</body>

</html>