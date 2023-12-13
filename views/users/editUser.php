<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>

    <form action="index.php?action=update&id=<?php echo $user['user_id']; ?>" method="post">
    <label>First name:</label>
        <input type="text" name="first_name" required><br>

        <label>Last name:</label>
        <input type="text" name="last_name" required><br>

        <label>Username:</label>
        <input type="number" name="username" required><br>

        <label>Email:</label>
        <input type="text" name="email" required><br>

        <label>Password:</label>
        <input type="text" name="password" required><br>

        <label>Location:</label>
        <input type="text" name="location_id" required><br>

        <label>Role:</label>
        <select name="role_id" required>

            <?php
            include(__DIR__. './configs/database.php');
            $query = "SELECT * FROM user_role";
            $result = $connection->query($query);

            if ($result) {
                while ($role = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$role['role_id']}'>{$role['NAME']}</option>";
                }
            }
            ?>

        </select><br>

        <label>Profile picture:</label>
        <input type="file" name="profile_picture" required><br>

        <input type="submit" value="Save">
    </form>
    <a href="index.php">Back to list</a>
</body>

</html>