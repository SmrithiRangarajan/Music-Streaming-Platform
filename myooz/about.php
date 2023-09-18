<?php
session_start();
include("connection.php");


$servername = "localhost";
$username = "root";
$password = "pixie123";
$dbname = "music_streaming_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetching details of all artists, albums and songs 
$query = "
    SELECT
        artists.artist_name AS artist_name,
        albums.album_name,
        albums.release_year,
        GROUP_CONCAT(songs.title ORDER BY songs.title ASC SEPARATOR ', ') AS songs_list
    FROM artists
    LEFT JOIN albums ON artists.artist_id = albums.artist_id
    LEFT JOIN songs ON albums.album_id = songs.album_id
    GROUP BY artists.artist_id
    ORDER BY artists.artist_name ASC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="home_style.css">
</head>
<body>
    <nav>
        <ul>
            <li class="brand"><img src="logo.png" alt="MYOOZ">BOOM</li>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="my_playlists.php">My Playlists</a></li>
            <li><a href="my_favourites.php">My Favourites</a></li>
            <li><a href="frequently_listened.php">Frequently Listened</a></li>
            <li><a href="about.php">Discover</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Artists</h1>
        <div class="artists">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="artist-item">';
                echo '<h2>' . $row["artist_name"] . '</h2>';
                echo '<table>';
                echo '<tr><th>Album Name</th><th>Release Year</th><th>Songs</th></tr>';
                echo '<tr>';
                echo '<td>' . $row["album_name"] . '</td>';
                echo '<td>' . $row["release_year"] . '</td>';
                echo '<td>' . $row["songs_list"] . '</td>';
                echo '</tr>';
                echo '</table>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/067799c4d0.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
