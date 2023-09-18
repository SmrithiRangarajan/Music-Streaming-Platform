<?php
session_start();
include("connection.php"); 

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['song']) && isset($_GET['playlist'])) {
    
    $userId = $_SESSION["user_id"]; 

    $songTitle = $_GET['song'];
    $playlistId = $_GET['playlist'];

    
    $songQuery = "SELECT song_id FROM songs WHERE title = '$songTitle'";
    $songResult = mysqli_query($con, $songQuery);

    if ($songResult && mysqli_num_rows($songResult) > 0) {
        $songRow = mysqli_fetch_assoc($songResult);
        $songId = $songRow['song_id'];

        // Checking if the song is already in the playlist
        $checkQuery = "SELECT * FROM playlist_songs WHERE playlist_id = $playlistId AND song_id = $songId";
        $checkResult = mysqli_query($con, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) === 0) {
            // Adding song 
            $insertQuery = "INSERT INTO playlist_songs (playlist_id, song_id) VALUES ($playlistId, $songId)";
            if (mysqli_query($con, $insertQuery)) {
                echo "added";
            } else {
                echo "error";
            }
        } else {
            // Removing the song from the playlist
            $removeQuery = "DELETE FROM playlist_songs WHERE playlist_id = $playlistId AND song_id = $songId";
            if (mysqli_query($con, $removeQuery)) {
                echo "removed";
            } else {
                echo "error";
            }
        }
    } else {
        echo "not_found";
    }
} else {
    echo "invalid_request";
}


mysqli_close($con);
?>
