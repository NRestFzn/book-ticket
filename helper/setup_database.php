<?php
$env = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/.env");
$DB_NAME = $env['DB_NAME'];

$sqlCollection = [
    "createDatabase" => "CREATE DATABASE IF NOT EXISTS {$DB_NAME}",

    "createTableUser" => "CREATE TABLE IF NOT EXISTS {$DB_NAME}.users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
];
?>