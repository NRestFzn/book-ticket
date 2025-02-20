<?php
  include("{$_SERVER['DOCUMENT_ROOT']}/utils/check_session.php");
  $checkSession = new CheckSession();

  $checkSession->ifNotExist();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/_global.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/home.css">
    <title>Home</title>
</head>
<body>
    <?php
        include("{$_SERVER['DOCUMENT_ROOT']}/components/navbar.php");
    ?>
    <div class="banner">
        <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/images/banner.jpg" alt="">
    </div>

    <div class="airing">
        <div class="poster">
            <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/images/poster.png" alt="">
        </div>
    </div>
</body>
</html>