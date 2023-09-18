<?php
session_start();
include("connection.php"); 

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['song'])) {
    
    $userId = $_SESSION["user_id"]; 

    $songTitle = $_GET['song'];

    
    $songQuery = "SELECT song_id FROM songs WHERE title = '$songTitle'";
    $songResult = mysqli_query($con, $songQuery);

    if ($songResult && mysqli_num_rows($songResult) > 0) {
        $songRow = mysqli_fetch_assoc($songResult);
        $songId = $songRow['song_id'];

        // Checking if the song is already in favorites
        $checkQuery = "SELECT * FROM user_favorites WHERE user_id = $userId AND song_id = $songId"; 
        $checkResult = mysqli_query($con, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) === 0) {
            // Add song to favorites
            $insertQuery = "INSERT INTO user_favorites (user_id, song_id) VALUES ($userId, $songId)"; 
            if (mysqli_query($con, $insertQuery)) {
                echo "added";
            } else {
                echo "error";
            }
        } else {
            // Remove the song from favorites
            $removeQuery = "DELETE FROM user_favorites WHERE user_id = $userId AND song_id = $songId"; 
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
