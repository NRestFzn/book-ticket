<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/_global.css" />
  <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/admin-dashboard/movie/update-movie/style.css">
  <title>Update Movie</title>
</head>

<body>
  <div class="update-movie">
    <div class=" poster-preview">
      <img id="poster" src="" alt="Movie Poster" srcset="">
    </div>
    <div class="update-form">
      <form onsubmit="updateMovie(event)" method="post" enctype="multipart/form-data" class="modal-form" id="modal-form">
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
    async function getById() {
      const raw = await fetch(
        `${window.location.origin}/controllers/MovieController/get_by_id.php?movie_id=<?php echo $_GET['movie_id'] ?>`, {
          method: "GET"
        }
      );

      const {
        status,
        data
      } = await raw.json();

      if (status !== "ok") {
        window.location.replace(
          `${window.location.origin}/pages/admin-dashboard/movie`
        );
        alert("movie not found");
      }

      const title = document.getElementById('title').value = data.title;
      const description = document.getElementById('description').value = data.description;
      const seatAmount = document.getElementById('seat_amount').value = data.seat_amount;
      const ticketPrice = document.getElementById('ticket_price').value = data.ticket_price;
      const movieStatus = document.getElementById('status').value = data.status;
      const moviePoster = document.getElementById('poster').src = "<?php $_SERVER['DOCUMENT_ROOT'] ?>" + data.poster

      return data
    }

    getById()

    async function updateMovie(event) {
      event.preventDefault()

      const formData = new FormData(event.target);
      formData.append("update_movie", 1);

      const raw = await fetch(
        `${window.location.origin}/controllers/MovieController/update.php?movie_id=<?php echo $_GET['movie_id'] ?>`, {
          method: "POST",
          body: formData
        }
      );
      window.location.replace("<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/admin-dashboard/movie")
      alert('success')
    }

    const posterInput = document.getElementById('file_upload');
    const poster = document.getElementById('poster')

    posterInput.onchange = event => {
      const [file] = posterInput.files;

      if (file) {
        poster.src = URL.createObjectURL(file);
      }
    }
  </script>
</body>

</html>