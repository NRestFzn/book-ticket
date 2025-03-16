<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/helper/sql_collection.php");
    $env = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/.env");
    if (!$env) {
        die("Error: Failed to load environment file.");
    }

    $DB_HOST = $env['DB_HOST'] ?? 'localhost';
    $DB_USER = $env['DB_USER'] ?? 'root';
    $DB_PASSWORD = $env['DB_PASSWORD'] ?? '';
    $DB_NAME = $env['DB_NAME'] ?? '';

    $dbConnection = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);

    $dbConnection->query("{$sqlCollection['createDatabase']}");

    $dbConnection->select_db($DB_NAME);

    foreach($sqlCollection as $key => $value) {
        $dbConnection->query($value);
    }
?>