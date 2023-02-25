<?php
session_start();
$user_id = $_SESSION['user_id'];
include('pdo.php');

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    if (empty($title) || empty($content) || empty($category)) {
        echo "Neki podaci nedostaju";
    } else {
        $date_time = date('Y-m-d H:m:s');
        $sql = "INSERT INTO posts(category, title, content, created_at, user_id)
        VALUES('$category', '$title', '$content', '$date_time', '$user_id')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivify Blog 2 - Create ad</title>
</head>

<body>
    <?php include("header.php"); ?>
    <h1>Create new ad</h1>
    <form action="create_new_ad.php" method="POST" id="adsForma">
        <ul>
            <li><label for="category">Category</label>
                <input type="text" id="category" name="category" placeholder="Enter category">
            </li>
            <li><label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter title">
            </li>
            <li><label for="content">Content</label>
                <textarea rows="10" id="content" name="content" placeholder="Enter content"></textarea>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
</body>

</html>