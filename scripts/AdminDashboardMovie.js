document.getElementById('by-title').onsubmit = function (event) {
  event.preventDefault();
  let title = document.getElementById('title-input').value;
  getAllMovie(title, '', '');
};

async function getAllMovie(title = '', sortBy = '', status = '') {
  const raw = await fetch(
    `${window.location.origin}/controllers/MovieController/get_all.php`,
    {method: 'GET'}
  );

  let {data} = await raw.json();

  if (data && data.length > 0) {
    if (title) {
      data = data.filter((movie) =>
        movie.title.toLowerCase().includes(title.toLowerCase())
      );
    }

    if (sortBy) {
      data.sort((a, b) => {
        if (sortBy === 'title') return a.title.localeCompare(b.title);
        if (sortBy === 'ticket_price') return a.ticket_price - b.ticket_price;
        if (sortBy === 'remaining_seat')
          return a.remaining_seat - b.remaining_seat;
        if (sortBy === 'remaining_seat')
          return a.remaining_seat - b.remaining_seat;
      });
    }

    if (status) {
      data = data.filter((e) => {
        return e.status == status;
      });
    }

    const movieData = document.getElementById('movie-data');

    movieData.innerHTML = ``;

    data.map((e, index) => {
      const tr = document.createElement('tr');

      tr.innerHTML = `<td>${index + 1}</td>
                         <td>
                         <img src="${window.location.origin}/${
        e.poster
      }" alt="Poster" width="50">
                         </td>
                         <td>${e.title}</td>
                         <td>${e.description}</td>
                         <td>${e.status}</td>
                         <td>${e.ticket_price}</td>
                         <td>${e.seat_amount}</td>
                         <td>${e.remaining_seat} / ${e.seat_amount}</td>
                         <td class="action-button">
                            <form method="POST" action="${
                              window.location.origin
                            }/pages/admin-dashboard/movie">
                                <button type="submit" name="delete_movie" value="${
                                  e.id
                                }" class="edit button">Edit</button>
                            </form>
                            <form method="POST" onsubmit="deleteMovie(event, ${
                              e.id
                            })">
                                <button type="submit" name="delete_movie" value="${
                                  e.id
                                }" class="delete button">Delete</button>
                            </form>
                         </td>`;

      movieData.appendChild(tr);
    });
  }
}

async function addMovie(event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  formData.append('add_movie', 1);

  const raw = await fetch(
    `${window.location.origin}/controllers/MovieController/add.php`,
    {
      method: 'POST',
      body: formData,
    }
  );

  const data = await raw.json();

  const modal = document.getElementById('modal-container');
  modal.style.display = 'none';

  const overlay = document.getElementById('overlay');

  overlay.style.display = 'block';

  alert(data.message);

  getAllMovie();
}

async function deleteMovie(event, id) {
  const formData = new FormData(event.target);

  formData.append('delete_movie', id);

  await fetch(
    `${window.location.origin}/controllers/MovieController/delete.php`,
    {method: 'POST', body: formData}
  );

  alert('success');
}

getAllMovie();

function showModal() {
  const modal = document.getElementById('modal-container');
  modal.style.display = 'block';

  const overlay = document.getElementById('overlay');

  overlay.style.display = 'none';
}

function hideModal() {
  const modal = document.getElementById('modal-container');
  modal.style.display = 'none';

  const overlay = document.getElementById('overlay');

  overlay.style.display = 'block';
}
