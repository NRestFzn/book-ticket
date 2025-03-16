<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/movie_detail.css">

<div id="modal-detail">
    <div class="modal-content">
        <div class="movie-poster">
            <img id="poster" alt="Movie Poster" srcset="">
        </div>

        <div class="movie-content">
            <span class="close" onclick="hideModalMovieDetail()">&times;</span>
            <label for="title">Title:</label>
            <input id='title' disabled />

            <label for="description">Description:</label>
            <input id='description' disabled />

            <label for="seat_amount">Seat Amount:</label>
            <input id='seat_amount' disabled />

            <label for="ticket_price">Ticket Price:</label>
            <input id='ticket_price' disabled />

            <label for="status">Status:</label>
            <input id='status' disabled />

            <label for="remaining_seat">Remaining Seat:</label>
            <input id='remaining_seat' disabled />
        </div>
    </div>
</div>