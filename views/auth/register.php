<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>

<body>
    <h1>Register</h1>
    <form action="users.php?action=storeUser" method="post">

        <?php

        include(__DIR__ . '/../users/createUser.php');

        ?>

    </form>
</body>

</html>
