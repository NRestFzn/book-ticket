<?php
session_start();

include("{$_SERVER['DOCUMENT_ROOT']}/config/database.php");
include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");

class AuthController {
    public function register($fullname, $username, $email, $password, $confirmPassword) {
        $duplicateEmail = query("SELECT email from users where email = '$email'");

        if (mysqli_num_rows($duplicateEmail) > 0) { 
            echo json_encode(["message" => "Email is already used"]);
            exit();
        }

        if(strlen($password) < 8 || strlen($confirmPassword) < 8) {
            echo json_encode(["message" => "Password and Confirm Password min 8 characters"]);
            exit();
        }

        if($password !== $confirmPassword) {
            echo json_encode(["message" => "Password and Confirm Password isn't matching"]);
            exit();
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $createUser = query("INSERT INTO users (fullname, username, email, password) value ('$fullname', '$username', '$email', '$password')");

        $_SESSION['user'] = [
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email
        ];

        echo json_encode(["status" => "success", "message" => "Account successfully registered", "redirectUrl" => "{$baseUrl}/pages/home.php"]);
        exit();
    }

    public function login($email, $password) {
        $findUser = query("SELECT username, email, password FROM users where email = '$email'");

        if(mysqli_num_rows($findUser) == 0) {
            echo json_encode(["message" => "Account not found"]);
            exit();
        }

        $verifyPassword = password_verify($password, mysqli_fetch_assoc($findUser)['password']);

        if(!$verifyPassword) {
            echo json_encode(['message' => 'Email or Password is incorrect']);
            exit();
        }

        $_SESSION['user'] = [
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email
        ];

        echo json_encode(["status" => "success", "message" => "Login successfully", "redirectUrl" => "{$baseUrl}/pages/home.php"]);
        exit();
    }
}
?>