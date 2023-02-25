<?php
session_start();
include('pdo.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if (empty($email) || empty($password) || empty($role)) {
        echo "Neki podaci nedostaju";
    } else {
        $sql = "INSERT INTO users(email, password, role) 
        VALUES ('$email', '$password', '$role')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql2 = "SELECT * FROM users WHERE users.email = email";
        $statement = $connection->prepare($sql2);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $user = $statement->fetch();
        $_SESSION["user_id"] = $user->id;

        header('Location: create_new_profile.php');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vivify Blog 2 - Create user</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php include("header.php"); ?>
    <form class="container" action="create_new_user.php" method="POST" id="usersForma">
        <h1>Create new user</h1>
        <ul>
            <li class="form-group">
                <label for="email" class='control-label'>Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email" class='form-control'>
            </li>
            <li class='form-group'>
                <label for="password" class='control-label'>Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" class='form-control'>
            </li>
            <li class="form-group">
                <label for="role" class='control-label'>Role</label>
                <input type="text" name="role" id="role" placeholder="Enter role" class='form-control'>
            </li>
            <li class="form-group">
                <button type="submit" name="submit" class='btn btn--primary'>Submit</button>
            </li>
        </ul>
    </form>
    <?php include('footer.php'); ?>
</body>

</html>