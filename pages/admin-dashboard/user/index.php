<?php
  include("{$_SERVER['DOCUMENT_ROOT']}/utils/check_session.php");
  $checkSession = new CheckSession();

  $checkSession->ifNotExist();
  $checkSession->ifNotAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/_global.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/admin-dashboard/user/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        include("{$_SERVER['DOCUMENT_ROOT']}/components/admin_navigation.php");
        include("{$_SERVER['DOCUMENT_ROOT']}/components/admin_header.php");
    ?>
    admin user
</body>
</html>