<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");

    session_start();
    session_destroy();
    header("Location: {$baseUrl}");
    exit();
?>
