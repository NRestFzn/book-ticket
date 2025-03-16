<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/movie_detail.css">

<div id="modal-detail">
    <div class="modal-content">
        <div class="movie-poster">
            <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/images/poster.png" alt="Movie Poster" srcset="">
        </div>

        <div class="movie-content">
            <span class="close" onclick="hideModalMovieDetail()">&times;</span>
            <label for="title">Title:</label>
            <input disabled />

            <label for="description">Description:</label>
            <input
                disabled />

            <label for="seat_amount">Seat Amount:</label>
            <input
                disabled />

            <label for="ticket_price">Ticket Price:</label>
            <input disabled />

            <label for="status">Status:</label>
            <select disabled>
                <option>Airing</option>
            </select>
        </div>
    </div>
</div>