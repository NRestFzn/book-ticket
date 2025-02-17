<?php
include("{$_SERVER['DOCUMENT_ROOT']}/helper/setup_database.php");
include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");

$env = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/.env");
$DB_HOST = $env['DB_HOST'];
$DB_USER = $env['DB_USER'];
$DB_PASSWORD = $env['DB_PASSWORD'];
$DB_NAME = $env['DB_NAME'];

try {
    $dbConnection = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);

    foreach($sqlCollection as $key => $value) {
        $dbConnection->query($value);
    }

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