<?php
include("connection.php");

if (isset($_GET['artistId'])) {
    $artistId = $_GET['artistId'];

    $query = "
    SELECT
        artists.artist_name,
        albums.album_name,
        albums.release_year,
        songs.title
    FROM
        artists
    LEFT JOIN
        albums ON artists.artist_id = albums.artist_id
    LEFT JOIN
        songs ON albums.album_id = songs.album_id
    WHERE
        artists.artist_id = $artistId
    ORDER BY
        albums.release_year, songs.track_number
    ";

    $result = mysqli_query($con, $query);

    if ($result) {
        $artistDetails = '<h2>' . mysqli_fetch_assoc($result)['artist_name'] . '</h2>';
        $artistDetails .= '<table>';
        
        while ($row = mysqli_fetch_assoc($result)) {
            $albumName = $row['album_name'];
            $releaseYear = $row['release_year'];
            $songTitle = $row['title'];

            $artistDetails .= '<tr>';
            $artistDetails .= '<td>' . $albumName . '</td>';
            $artistDetails .= '<td>' . $releaseYear . '</td>';
            $artistDetails .= '<td>' . $songTitle . '</td>';
            $artistDetails .= '</tr>';
        }

        $artistDetails .= '</table>';
        echo $artistDetails;
    }
}

mysqli_close($con);
?>
