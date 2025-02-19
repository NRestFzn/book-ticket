<?php
include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");

try {
    session_start();

    if (isset($_SESSION['user'])) {
        header("Location: {$baseUrl}/pages/home.php");
        exit();
    }

    header("Location: {$baseUrl}/pages/login.php");
    exit();
} catch (Exception $e) {
    echo "Database Connection Failed : {$e->getMessage()}";
}
?>