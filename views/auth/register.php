<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>

<body>
    <h1>Register</h1>
    <form action="auth.php?action=register" method="post">

        <?php

        include('forms/formRegister.php');

        ?>

    </form>
</body>

</html>
