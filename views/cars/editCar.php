<?php

include('../configs/database.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit car</title>
</head>

<body>
    <h1>Edit car</h1>
    <form action="cars.php?action=update&id=<?php echo $car['id']; ?>">

        <?php

        include('forms/formCar.php');

        ?>

    </form>
    <a href="cars.php">Back to list</a>

    <script src="js/main.js"></script>
</body>

</html>