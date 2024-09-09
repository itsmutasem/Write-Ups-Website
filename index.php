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
    <link href="css/Home.css" rel="stylesheet">
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
        Welcome<br>
    </div>

    <div class="posts-container">
        <!-- Example of 6 posts -->
        <div class="post" data-title="Post 2">
            <img src="img/logo.png" alt="Post 2">
        </div>
        <div class="post" data-title="Post 2">
            <img src="img/logo.png" alt="Post 2">
        </div>
        <div class="post" data-title="Post 3">
            <img src="img/logo.png" alt="Post 3">
        </div>
        <div class="post" data-title="Post 4">
            <img src="img/logo.png" alt="Post 4">
        </div>
        <div class="post" data-title="Post 5">
            <img src="img/logo.png" alt="Post 5">
        </div>
        <div class="post" data-title="Post 6">
            <img src="img/logo.png" alt="Post 6">
        </div>
    </div>


    <footer class="footer">
        © 2024 Bracken. All rights reserved.
    </footer>

    <script>
        document.querySelector('.burger-menu').addEventListener('click', function () {
            document.querySelector('.menu-links').classList.toggle('active');
        });

        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                document.body.classList.add('loaded');
            }, 500); // Delay to show the scroll animation
        });
    </script>
</body>

</html>