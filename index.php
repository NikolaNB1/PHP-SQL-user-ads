<?php
session_start();
$user_id = $_SESSION['user_id'];
include("pdo.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivify Blog 2</title>
</head>

<body>
    <?php include("header.php"); ?>
    <h1>Welcome</h1>
</body>

</html>