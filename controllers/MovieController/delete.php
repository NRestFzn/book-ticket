<?php
  include("{$_SERVER['DOCUMENT_ROOT']}/controllers/MovieController/_service.php");

  $movie_service = new MovieServices();
    if(isset($_POST['delete_movie'])) {
        include("{$_SERVER['DOCUMENT_ROOT']}/helper/base_url.php");
        $movie_service->deleteMovie($_POST['delete_movie']);
    }
?>