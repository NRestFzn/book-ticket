<?php
include("{$_SERVER['DOCUMENT_ROOT']}/utils/check_session.php");
$checkSession = new CheckSession();

$checkSession->ifNotExist();
$checkSession->ifNotAdmin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/_global.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/styles/table.css">
    <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/pages/admin-dashboard/movie/style.css">
    <title>Movie</title>
</head>

<body>
    <?php include include("{$_SERVER['DOCUMENT_ROOT']}/components/movie_detail.php"); ?>

    <?php
    include("{$_SERVER['DOCUMENT_ROOT']}/components/admin_navigation.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/components/admin_header.php");
    ?>
    <div class="main-container">
        <h1>Movie List</h1>
        <div class="select-option">
            <form onsubmit="getMovieByTitle(event)">
                <input type="text" name="title" id="title-input" placeholder="Search by title">
            </form>
            <select id="sort-options" onchange="getAllMovie('', this.value, '')">
                <option value="">Sort by...</option>
                <option value="title">Title</option>
                <option value="ticket_price">Ticket Price</option>
                <option value="remaining_seat">Remaining Seats</option>
            </select>

            <select id="filter-status" onchange="getAllMovie('', '', this.value)">
                <option value="">Status...</option>
                <option value="airing">Airing</option>
                <option value="upcoming">Up Coming</option>
            </select>

            <button onclick="getAllMovie()">Reset</button>
            <button class="add-movie" onclick="showModal()">Add movie</button>
        </div>
        <table id="table">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <tbody id="movie-data">

            </tbody>
        </table>
    </div>
    <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/scripts/AdminDashboardMovie.js"></script>
</body>

</html>