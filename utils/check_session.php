<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");
    session_start();

    class CheckSession {
        function ifNotExist() {
            if(!isset($_SESSION['userlogin'])) {
                header("Location: {$baseUrl}/pages/login");
                exit();
            }
        }

        function ifNotAdmin() {
            if(isset($_SESSION['userlogin']) && $_SESSION['userlogin']['role_id'] != 1) {
                header("Location: {$baseUrl}/pages/login");
                exit();
            }
        }
    }
?>