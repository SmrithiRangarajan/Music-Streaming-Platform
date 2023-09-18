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

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['songId'])) {
    $songId = $_GET['songId'];
    $userId = $_SESSION['user_id'];

    // Inserting a new record 
    $query = "INSERT INTO play_history (user_id, song_id) VALUES ($userId, $songId)";
    mysqli_query($conn, $query); 
}
?>

