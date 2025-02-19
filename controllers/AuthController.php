<?php
session_start();

include("{$_SERVER['DOCUMENT_ROOT']}/config/database.php");
include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");

class AuthController {
    public function register($fullname, $username, $email, $password, $confirmPassword) {
        $duplicateEmail = mysqli_fetch_assoc(query("SELECT email from users where email = '$email'"));

        if ($duplicateEmail) { 
            echo json_encode(["message" => "Email is already used"]);
            exit();
        }

        if(strlen($password) < 8 || strlen($confirmPassword) < 8) {
            echo json_encode(["message" => "Password and Confirm Password min 8 characters"]);
            exit();
        } else if($password !== $confirmPassword) {
            echo json_encode(["message" => "Password and Confirm Password isn't matching"]);
            exit();
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $createUser = query("INSERT INTO users (fullname, username, email, password) value ('$fullname', '$username', '$email', '$password')");

        $findUser = query("SELECT * FROM users where email = '{$email}'");

        $_SESSION['userlogin'] = $findUser;

        echo json_encode(["status" => "success", "message" => "Account successfully registered", "redirectUrl" => "{$baseUrl}/pages/home.php"]);
        exit();
    }

    public function login($email, $password) {
        $findUser = mysqli_fetch_assoc(query("SELECT * FROM users where email = '$email'"));

        if(!$findUser) {
            echo json_encode(["message" => "Account not found"]);
            exit();
        }

        $verifyPassword = password_verify($password, $findUser['password']);

        if(!$verifyPassword) {
            echo json_encode(['message' => 'Email or Password is incorrect']);
            exit();
        }

        $_SESSION['userlogin'] = $findUser;

        echo json_encode(["status" => "ok", "message" => "Login successfully", "redirectUrl" => "{$baseUrl}/pages/home.php"]);
        exit();
    }
}
?>