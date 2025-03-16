<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/_global.css" />
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/admin-dashboard/movie/add-movie/style.css">
    <title>Add Movie</title>
</head>

<body>
    <div class="add-movie" id="add-movie">
        <div class="poster-preview" id="poster-preview"></div>
        <div class="add-form" id="add-form">
            <form onsubmit="addMovie(event)" method="post" enctype="multipart/form-data" class="modal-form" id="modal-form">
                <label for="title">Title:</label>
                <input required type="text" name="title" id="title" placeholder="Title" />

                <label for="description">Description:</label>
                <input
                    required
                    type="text"
                    name="description"
                    id="description"
                    placeholder="Description" />

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
                    placeholder="Ticket price"
                    min=1 />

                <label for="poster">Poster:</label>
                <input type="file" name="file_upload" id="file_upload" />

                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="airing">Airing</option>
                    <option value="upcoming">Up Coming</option>
                </select>

                <button type="submit" name="update_movie">Update Movie</button>
            </form>
        </div>
    </div>

    <script>
        async function addMovie(event) {
            event.preventDefault()

            const formData = new FormData(event.target);
            formData.append("add_movie", 1);

            const raw = await fetch(
                `${window.location.origin}/controllers/MovieController/add.php`, {
                    method: "POST",
                    body: formData
                }
            );

            window.location.replace("<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/admin-dashboard/movie")
            alert('success')
        }

        const posterInput = document.getElementById('file_upload');
        const posterPreview = document.getElementById('poster-preview')
        const addForm = document.getElementById('add-form')
        const addMovieContainer = document.getElementById('add-movie')

        posterInput.onchange = event => {
            const [file] = posterInput.files;

            if (file) {
                addMovieContainer.style.width = '990px'
                posterPreview.style = {
                    width: "35%",
                    height: "100%"
                }
                addForm.style.width = "65%"
                posterPreview.innerHTML = `<img alt="Movie Poster" src=${URL.createObjectURL(file)} />`
            }
        }
    </script>
</body>

</html>