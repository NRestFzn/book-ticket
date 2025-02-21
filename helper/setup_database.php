<?php
$env = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/.env");
$DB_NAME = $env['DB_NAME'];

$defaultPassword = password_hash('12345678', PASSWORD_DEFAULT);

$sqlCollection = [
    "createDatabase" => "CREATE DATABASE IF NOT EXISTS {$DB_NAME}",

    "createTableUser" => "CREATE TABLE IF NOT EXISTS {$DB_NAME}.users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role_id INT NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "createRoleTable" => "CREATE TABLE IF NOT EXISTS {$DB_NAME}.roles (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255) NOT NULL UNIQUE,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "insertDefaultRoles" => "INSERT IGNORE INTO {$DB_NAME}.roles (id, name) values (1, 'admin'), (2, 'user')",

    "userAddRoleIdForeignKey" => "ALTER TABLE {$DB_NAME}.users ADD CONSTRAINT fk_users_roles FOREIGN KEY (role_id) 
                                  REFERENCES roles(id) ON UPDATE CASCADE ON DELETE CASCADE;",

    "addDefaultUser" => "INSERT IGNORE INTO {$DB_NAME}.users (fullname, username, email, password, role_id) values
                        ('test admin', 'test_admin', 'testadmin@mail.com', '{$defaultPassword}', 1),
                        ('test user', 'test_user', 'testuser@mail.com', '{$defaultPassword}', 2)",

    "createTableMovie" => "CREATE TABLE IF NOT EXISTS {$DB_NAME}.movies (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        title VARCHAR(255) NOT NULL,
                        description VARCHAR(255) NOT NULL,
                        status VARCHAR(255) NOT NULL,
                        seat_amount INT NOT NULL,
                        remaining_seat INT NOT NULL DEFAULT 0,
                        ticket_price DECIMAl(10, 2),
                        poster VARCHAR(255),
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP)",
];
?>