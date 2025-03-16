<?php
include("{$_SERVER['DOCUMENT_ROOT']}/controllers/MovieController/_service.php");

$movie_service = new MovieServices();

if (isset($_POST['update_movie'])) {
  include("{$_SERVER['DOCUMENT_ROOT']}/helper/file_handler.php");
  $fileHandler = new FileHandler();
  $filePath = $fileHandler->uploadFile("{$_SERVER['DOCUMENT_ROOT']}/uploads/");

  echo $movie_service->updateMovie(
    $_GET['movie_id'],
    $_POST['title'],
    $_POST['description'],
    $_POST['seat_amount'],
    $_POST['ticket_price'],
    $filePath,
    $_POST['status']
  );
}
