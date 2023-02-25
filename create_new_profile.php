<?php
session_start();
$user_id = $_SESSION['user_id'];
include('pdo.php');

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $country = $_POST['country'];
    $profession = $_POST['profession'];
    if (empty($first_name) || empty($last_name) || empty($date_of_birth) || empty($country) || empty($profession)) {
        echo "Neki podaci nedostaju";
    } else {
        $sql = "INSERT INTO profiles(first_name, last_name, date_of_birth, country, profession, user_id) 
        VALUES ('$first_name', '$last_name', '$date_of_birth', '$country', '$profession', '$user_id')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vivify Blog 2 - Create profile</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php include("header.php"); ?>
    <form class="container" action="create_new_profile.php" method="POST" id="profilesForma">
        <h1>Create new profile</h1>
        <ul>
            <li class="form-group">
                <label for="first_name" class='control-label'>First name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter first name" class='form-control'>
            </li>
            <li class="form-group">
                <label for="last_name" class='control-label'>Last name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter last name" class='form-control'>
            </li>
            <li class="form-group">
                <label for="date_of_birth" class='control-label'>Date of birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class='form-control'>
            </li>
            <li class="form-group">
                <label for="country" class='control-label'>Country</label>
                <input type="text" placeholder="Enter country" name="country" id="country" class='form-control'>
            </li>
            <li class="form-group">
                <label for="profession" class='control-label'>Profession</label>
                <input type="text" placeholder="Enter profession" name="profession" id="profession" class='form-control'>
            </li>
            <li class="form-group">
                <button type="submit" name="submit" class='btn btn--primary'>Submit</button>
            </li>
        </ul>
    </form>
    <?php include('footer.php'); ?>
</body>

</html>