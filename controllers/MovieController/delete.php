<?php
include("{$_SERVER['DOCUMENT_ROOT']}/controllers/MovieController/_service.php");

$movie_service = new MovieServices();

include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");
$movie_service->deleteMovie($_GET['id']);
