<?php

include('../configs/database.php');
$user = null;

?>

<!DOCTYPE html>
<html>

<head>
    <title>New user</title>
</head>

<body>
    <h1>New user</h1>
    <form action="index.php?action=store" method="post">

        <?php

        include('forms/formUser.php');

        ?>

    </form>
    <a href="users.php">Back to list</a>

    <script src="js/main.js"></script>
</body>

</html>