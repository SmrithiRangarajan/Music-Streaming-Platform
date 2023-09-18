<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "pixie123";
$dbname = "music_streaming_db";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die("failed to connect!");
}
