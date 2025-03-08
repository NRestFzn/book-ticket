<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/movie_detail.css">

<div id="modal-detail">
    <div class="modal-content">
        <label for="title">Title:</label>
        <input required type="text" name="title" id="title" placeholder="Enter event title" />

        <label for="description">Description:</label>
        <input
            required
            type="text"
            name="description"
            id="description"
            placeholder="Enter event description" />

        <label for="seat_amount">Seat Amount:</label>
        <input
            required
            type="number"
            name="seat_amount"
            id="seat_amount"
            placeholder="Seat Amount"
            min=1 />

        <label for="ticket_price">Ticket Price:</label>
        <input
            required
            type="number"
            name="ticket_price"
            id="ticket_price"
            placeholder="Enter ticket price"
            min=1 />

        <label for="poster">Poster:</label>
        <input required type="file" name="file_upload" id="file_upload" />

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="airing">Airing</option>
            <option value="upcoming">Up Coming</option>
        </select>
    </div>
</div>