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
        $_SESSION["user_id"] = $user['id'];

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

</head>

<body>
    <?php include("header.php"); ?>
    <h1>Create new user</h1>
    <form action="create_new_user.php" method="POST" id="usersForma">
        <ul>
            <li>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
            </li>
            <li>
                <label for="role">Role</label>
                <input type="text" name="role" id="role" placeholder="Enter role"><br>
            </li>
            <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>

</body>

</html>