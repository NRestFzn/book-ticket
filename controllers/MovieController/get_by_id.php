<?php
  include("{$_SERVER['DOCUMENT_ROOT']}/controllers/MovieController/_service.php");

  $movie_service = new MovieServices();
  
  header('Content-Type: application/json');
  
  echo $movie_service->getById($_GET['movie_id']);
  
  exit();
?>