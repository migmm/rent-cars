<!DOCTYPE html>
<html>

<head>
    <title>User list</title>
</head>

<body>
    <h1>User list</h1>
    <a href="index.php?action=createUser">Add new User</a>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>City</th>
            <th>Country</th>
            <th>Role</th>

            <th>Profile picture</th>
            <th>Rentals</th>
            <th>Payment method</th>
            <th>Action</th>
        </tr>

        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['password']; ?></td>
                <td><?php echo $user['city_id']; ?></td>
                <td><?php echo $user['country_id']; ?></td>
                <td><?php echo $user['role_id']; ?></td>
                <td><?php echo $user['profile_picture']; ?></td>
                <td>
                    <?php foreach ($user['rentals'] as $rental) : ?>
                        <?php echo $rental['start_date'] . ' to ' . $rental['end_date']; ?><br>
                    <?php endforeach; ?>
                </td>

                <td>
                    <?php foreach ($user['paymentMethods'] as $paymentMethod) : ?>
                        <?php echo $paymentMethod['method_name'] . ': ' . $paymentMethod['card_number']; ?><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <a href="index.php?action=editUser&id=<?php echo $user['id']; ?>">Edit</a>
                    <a href="index.php?action=deleteUser&id=<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>