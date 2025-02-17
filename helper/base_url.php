<?php
    $serverProtocol = strtolower(explode("/", $_SERVER['SERVER_PROTOCOL'])[0]);
    $baseUrl = "{$serverProtocol}://{$_SERVER['HTTP_HOST']}";
?>