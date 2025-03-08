function getMovieByTitle(event) {
  event.preventDefault();

  let title = document.getElementById("title-input").value;

  getAllMovie(title, "", "");
}

async function getAllMovie(title = "", sortBy = "", status = "") {
  const raw = await fetch(
    `${window.location.origin}/controllers/MovieController/get_all.php`,
    { method: "GET" }
  );

  let { data } = await raw.json();

  if (data && data.length > 0) {
    if (title) {
      data = data.filter(movie =>
        movie.title.toLowerCase().includes(title.toLowerCase())
      );
    }

    if (sortBy) {
      data.sort((a, b) => {
        if (sortBy === "title") return a.title.localeCompare(b.title);
        if (sortBy === "ticket_price") return a.ticket_price - b.ticket_price;
        if (sortBy === "remaining_seat")
          return a.remaining_seat - b.remaining_seat;
        if (sortBy === "remaining_seat")
          return a.remaining_seat - b.remaining_seat;
      });
    }

    if (status) {
      data = data.filter(e => {
        return e.status == status;
      });
    }

    const movieData = document.getElementById("movie-data");

    movieData.innerHTML = ``;

    data.map((e, index) => {
      const tr = document.createElement("tr");

      tr.innerHTML = `<td>${index + 1}</td>
                      <td id="title-data">${e.title}</td>
                      <td>${e.status}</td>
                      <td class="action">
                        <a href=${
                          window.location.origin
                        }/pages/admin-dashboard/movie/update?movie_id=${e.id}>
                          <button class="edit">Edit</button>
                        </a>
                        <button class="detail" onclick="showDetail()">Detail</button>
                        <button class="delete">Delete</button>
                      </td>`;

      movieData.appendChild(tr);
    });
  }
}

async function addMovie(event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  formData.append("add_movie", 1);

  const raw = await fetch(
    `${window.location.origin}/controllers/MovieController/add.php`,
    {
      method: "POST",
      body: formData,
    }
  );

  const data = await raw.json();

  const modal = document.getElementById("modal-container");
  modal.style.display = "none";

  const overlay = document.getElementById("overlay");

  overlay.style.display = "block";

  alert(data.message);

  getAllMovie();
}

async function deleteMovie(event, id) {
  const formData = new FormData(event.target);

  formData.append("delete_movie", id);

  await fetch(
    `${window.location.origin}/controllers/MovieController/delete.php`,
    { method: "POST", body: formData }
  );

  window.location.replace(`${window.location.origin}`);

  alert("success");
}

getAllMovie();

function showModal() {
  const modal = document.getElementById("modal-container");
  modal.style.display = "block";

  const overlay = document.getElementById("overlay");

  overlay.style.display = "none";
}

function hideModal() {
  const modal = document.getElementById("modal-container");
  modal.style.display = "none";

  const overlay = document.getElementById("overlay");

  overlay.style.display = "block";
}

function showDetail() {
  const modalDetail = document.getElementById("modal-detail");
  modalDetail.style.display = "block";
}

window.onclick = function (event) {
  const modalDetail = document.getElementById("modal-detail");
  if (modalDetail && event.target === modalDetail) {
    modalDetail.style.display = "none";
  }
};
