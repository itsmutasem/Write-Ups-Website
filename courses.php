<?php
session_start();
@$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radare2 CTF</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
</head>
<body>
<div class="menu">
    <div class="logo">
        <a href="Home.html">Home</a>
    </div>
    <div class="menu-links">
        <a href="index.php">Home</a>
        <a href="writeups.php">Write ups</a>
        <a href="courses.php">Courses</a>
        <a href="#">Join Us</a>
        <?php
        if (isset($_SESSION['name'])){
            echo "<a href=\"profile.php\">$username</a>";
        }else{
            echo "<a href='login.php'>Login</a>";
        }
        ?>
    </div>
    <div class="burger-menu">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
</div>
        <div class="title">
            Comming soon :) <br>
        </div>
    </div>
</body>
</html>
