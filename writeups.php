<?php
session_start();
@$username = $_SESSION['username'];
// Database connection
$conn = mysqli_connect("localhost", "root", "", "bracken");

// Fetch data from the writeup table
$query = "SELECT name, title, link, picture FROM writeup";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writeups</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="css/writeups.css" rel="stylesheet">
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
    <?php
    if (@$_SESSION['admin'] === true){
        echo '<a style="margin-top: 100px" href="writeups_admin.php"><button style="padding: 10px; border-radius: 10px">Write ups management</button></a>';
    }
    ?>
    <div class="writeups-container">
        <?php
        // Check if there are results
        if (mysqli_num_rows($result) > 0) {
        // Loop through each row and display the data
            while($row = mysqli_fetch_assoc($result)) {
                $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
                $link = htmlspecialchars($row['link'], ENT_QUOTES, 'UTF-8');
                $picture = htmlspecialchars($row['picture'], ENT_QUOTES, 'UTF-8');
        ?>
        <div class="writeup-box">

            <img src="img/<?php echo $picture; ?>" alt="<?php echo $title; ?>">
            <div class="writeup-content">
                <h3><?php echo $title ?></h3>
                <p>Author: <?php echo $name?></p>
                <a href="<?php echo $link; ?>" target="_blank" class="read-more-button">Read more</a>

            </div>
        </div>
        <?php
        }
        } else {
            echo "<p>No write ups in database</p>";
        }
        ?>
    </div>

    <footer class="footer">
        © 2024 Bracken. All rights reserved.
    </footer>

    <script>
        document.querySelector('.burger-menu').addEventListener('click', function () {
            document.querySelector('.menu-links').classList.toggle('active');
        });
    </script>
</body>
</html>
