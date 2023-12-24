<?php

include('../configs/database.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Car</title>
</head>

<body>
    <h1>Edit Car</h1>

    <form action="cars.php?action=updateCar&id=<?php echo $car['id']; ?>" method="post">
    
        <?php

        include('forms/formCar.php');

        ?>

    </form>
    <a href="index.php">Back to list</a>

    <script src="js/main.js"></script>
</body>

</html>