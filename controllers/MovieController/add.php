<?php
include("{$_SERVER['DOCUMENT_ROOT']}/controllers/MovieController/_service.php");

$movie_service = new MovieServices();
if (isset($_POST['add_movie'])) {
  include("{$_SERVER['DOCUMENT_ROOT']}/helper/file_handler.php");
  $fileHandler = new FileHandler();
  $filePath = $fileHandler->uploadFile("{$_SERVER['DOCUMENT_ROOT']}/uploads/");
  $movie_service->addMovie(
    $_POST['title'],
    $_POST['description'],
    $_POST['status'],
    $_POST['seat_amount'],
    $_POST['ticket_price'],
    $filePath
  );
}
