<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$servername = "localhost";
$username = "root";
$password = "pixie123";
$dbname = "music_streaming_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['remove_song'])) {
    $songId = $_POST['remove_song'];

    // Assuming the user is logged in and you have their user_id stored in a session variable
    $userId = $_SESSION["user_id"];

    // Remove the song from favorites
    $removeQuery = "DELETE FROM user_favorites WHERE user_id = $userId AND song_id = $songId";
    if (mysqli_query($conn, $removeQuery)) {
        // Redirect back to the favorites page after removing the song
        header("Location: my_favourites.php");
        exit();
    } else {
        echo "Error removing the song.";
    }
}

// Fetch favorited songs for the user
$userId = $_SESSION["user_id"];
$query = "SELECT songs.song_id, songs.title, songs.cover_path FROM songs
          INNER JOIN user_favorites ON songs.song_id = user_favorites.song_id
          WHERE user_favorites.user_id = $userId";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favourites</title>
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
        <div class="songlist">
            <h1>My Favourites</h1>
            <div class="songcontainer">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="songitem">';
                        echo '<img src="' . $row["cover_path"] . '" alt="' . $row["title"] . '">';
                        echo '<span>' . $row["title"] . '</span>';
                        echo '<form method="post">';
                        echo '<input type="hidden" name="remove_song" value="' . $row["song_id"] . '">';
                        echo '<button type="submit">Remove</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Your favourites list is empty!</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/067799c4d0.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
