<?php
session_start();
    include("connection.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myoozik</title>
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
            <li><a href="Logout.php">Logout</a></li>
        </ul>

        <div class="container">
            <div class="songlist">
                <h1>Trending</h1>
                <div class="songcontainer">
                    <div class="songitem">
                        <img src="ts.jpg" alt="1">
                        <span>Call It What You Want</span>
                        <span class="songlistplay"><span class="timestamp">05:56 <i id="Call it what you want" class="fa-regular songitemplay fa-circle-play" data-song-id="2" data-song-title="Call it what you want"></i></span><i id="Call it what you want" class="fa-regular fa-heart addtofavourites" data-song="Call it what you want"></i><button class="addtoplaylist" data-song="Call it what you want" data-playlist-id="1">Add to Playlist</button></span>
                        

                        
    
                    </div>
                    <div class="songitem">
                        <img src="ed.jpg" alt="1">
                        <span>Bad Habits</span>
                        <span class="songlistplay"><span class="timestamp">04:28 <i id="Bad Habits" class="fa-regular songitemplay fa-circle-play" data-song-id="5" data-song-title="Bad Habits"></i></span><i id="Bad Habits" class="fa-regular fa-heart addtofavourites" data-song="Bad Habits"></i><button class="addtoplaylist" data-song="Bad Habits" data-playlist-id="1">Add to Playlist</button></span>
                        

    
                    </div>
                    <div class="songitem">
                        <img src="am.jpg" alt="1">
                        <span>Do I Wanna Know</span>
                        <span class="songlistplay"><span class="timestamp">05:02 <i id="Do i Wanna Know" class="fa-regular songitemplay fa-circle-play" data-song-id="8" data-song-title="Do I Wanna Know"></i></span><i id="Do i Wanna Know" class="fa-regular fa-heart addtofavourites" data-song="Do I Wanna Know"></i><button class="addtoplaylist" data-song="Do i Wanna Know" data-playlist-id="1">Add to Playlist</button></span>
                       
                        

    
                    </div>
                </div>
                
            </div>

            <div class="songbanner"></div>

        </div>
        <div class="bottom">
            <input type="range" name="range" id="progressbar" min="0" value="0" max="100">
            <div class="icons">
                <i class="fas fa-2x fa-step-backward"></i>
                <i class="fa-regular fa-2x fa-circle-play" id="playbutton"></i>
                <i class="fas fa-2x fa-step-forward"></i>
            </div>
        </div>
    </nav>
    <script src="https://kit.fontawesome.com/067799c4d0.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    
</body>
</html>