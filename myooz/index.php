<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>MYOOZIK</title>
</head>
<body>
    <a href="Logout.php">Logout</a>

    <br>
    Hello, <?php echo $user_data['username']; ?>

</body>
</html>
