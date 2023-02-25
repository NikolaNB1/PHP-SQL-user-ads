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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("header.php"); ?>
    <?php
    $sql = "SELECT users.email, p.* FROM posts AS p
            INNER JOIN users ON users.id = p.user_id
            ORDER BY p.created_at DESC LIMIT 3";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $statement->fetchAll();
    ?>

    <?php
    foreach ($posts as $post) {
    ?>
        <article class="article">
            <header>
                <h1><a href="update_ad.php<?php echo ($post['id']) ?>">
                        <?php echo ($post['title']) ?></a></h1>

                <div><?php echo ($post['created_at']) ?>. by
                    <?php echo ($post['email']) ?></div>
            </header>
        </article>

    <?php
    }
    ?>
    <div class="paginator">
        <a href="list_ads.php" title="All ads">All ads</a>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>