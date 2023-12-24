<?php

include('../configs/database.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>

    <form action="users.php?action=updateUser&id=<?php echo $user['id']; ?>" method="post">

        <?php

        include('forms/formUser.php');

        ?>

    </form>
    <a href="index.php">Back to list</a>

    <script src="js/main.js"></script>
</body>

</html>