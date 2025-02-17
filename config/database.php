<?php
$env = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/.env");
if (!$env) {
    die("Error: Failed to load environment file.");
}

$DB_HOST = $env['DB_HOST'] ?? 'localhost';
$DB_USER = $env['DB_USER'] ?? 'root';
$DB_PASSWORD = $env['DB_PASSWORD'] ?? '';
$DB_NAME = $env['DB_NAME'] ?? '';

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $dbConnection = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

} catch (mysqli_sql_exception $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

function query($sql) {
    global $dbConnection;
    return $dbConnection->query($sql);
}
?>
