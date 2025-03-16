<?php
include("{$_SERVER['DOCUMENT_ROOT']}/config/database.php");

class MovieServices
{
    public function getAllMovie()
    {
        $query = "SELECT * FROM movies";
        $title = isset($_GET['title']) ? $_GET['title'] : '';

        if (!empty($title)) {
            $query = "SELECT * FROM movies WHERE title LIKE '%$title%'";
        }

        $movies = query($query);

        return json_encode(["status" => "ok", "data" => mysqli_fetch_all($movies, MYSQLI_ASSOC)], JSON_NUMERIC_CHECK);
        exit();
    }

    public function addMovie($title, $description, $status, $seat_amount, $ticket_price, $poster)
    {
        query("INSERT INTO movies (title, description, status, seat_amount, remaining_seat, ticket_price, poster)
               value ('$title', '$description', '$status', '$seat_amount', '$seat_amount', '$ticket_price', '$poster')");

        echo json_encode(['message' => 'Success add new movie']);
    }

    public function deleteMovie($id)
    {
        $findMovie = mysqli_fetch_assoc(query("SELECT * FROM movies where id = $id"));

        if (!$findMovie) {
            echo json_encode(["message" => "Movie not found"]);
            exit();
        }

        $movie_id = $findMovie['id'];

        query("DELETE FROM movies WHERE id = $movie_id");
        exit();
    }

    public function getById($id)
    {
        $findMovie = mysqli_fetch_assoc(query("SELECT * FROM movies where id = '$id'"));

        if (!$findMovie) {
            echo json_encode(["status" => "notok", "message" => "Movie not found"]);
            exit();
        }

        echo json_encode(['status' => 'ok', 'data' => $findMovie]);
    }

    public function updateMovie($id, $title, $description, $seat_amount, $ticket_price, $poster, $status)
    {
        $findMovie = mysqli_fetch_assoc(query("SELECT * FROM movies where id = '$id'"));

        $this->getById($findMovie['id']);

        isset($poster) ? $poster = $poster : $poster = $findMovie['poster'];

        query("UPDATE movies SET
                title='$title',
                description='$description',
                seat_amount=$seat_amount,
                ticket_price=$ticket_price,
                poster='$poster',
                status='$status'
                WHERE id=$id");
    }
}
