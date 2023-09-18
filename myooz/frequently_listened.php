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

$query = "SELECT * FROM songs ORDER BY play_count DESC LIMIT 2"; // Retrieve 2 songs 
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Listened</title>
    <link rel="stylesheet" href="home_style.css">
    <style>
        .song-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .song-item {
            flex: 0 0 calc(50% - 20px);
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .song-item img {
            max-width: 100%;
            border-radius: 5px;
        }

        .song-title {
            margin-top: 10px;
            font-weight: bold;
            text-align: center;
            color: #777;
        }

        .play-count {
            margin-top: 5px;
            color: #777;
        }
    </style>
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
        <h1>Frequently Listened Songs</h1>
        <div class="song-list">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="song-item">';
                echo '<img src="' . $row["cover_path"] . '" alt="' . $row["title"] . '">';
                echo '<span class="song-title">' . $row["title"] . '</span>';
                echo '<span class="play-count">Play Count: ' . $row["play_count"] . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/067799c4d0.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
