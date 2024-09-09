<?php
// session start
session_start();
// database connection
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bracken', 'root', '');
//
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mailer/autoload.php';
// lowercase
@$username = strtolower($_POST['username']);
// Check if password and confirm password match
if (@$_POST['password'] === @$_POST['confirm-password']) {
    // Check if all required fields are set
    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email'])
        && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['gender'])) {
        // Check if the username already exists in the database
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':username' => $_POST['username']));
        // If username exists, show an error message
        if ($stmt->rowCount() > 0) {
            $error_username_exists = "Username already exists. Please choose another one.";
//            echo "<p>Username already exists. Please choose another one.</p>";
        } else {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['password'] = $_POST['password'];
            // If username does not exist, add to database
            $sql = "INSERT INTO users (name, username, email, phone, password, gender)
                       VALUES (:name, :username, :email, :phone, :password, :gender)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':name' => $_POST['name'],
                ':username' => $username,
                ':email' => $_POST['email'],
                ':phone' => $_POST['phone'],
                ':password' => md5($_POST['password']), // Hash the password
                ':gender' => $_POST['gender'],

            ));
            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        }
    }
} else {
    // If password and confirm password do not match
    $error_password = "Passwords do not match.";
//    echo "<p>Passwords do not match.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Radare2 CTF</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <div class="menu">
        <div class="logo">
            <a href="index.php">Bracken</a>
        </div>
        <div class="menu-links">
            <a href="index.php">Home</a>
            <a href="writeups.php">Write ups</a>
            <a href="courses.php">Courses</a>
            <a href="#">Join Us</a>
            <a href="login.php">Login</a>
        </div>
        <div class="burger-menu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>

    <div class="login-container">
        <h1>Register</h1>
        <form method="post">

            <input type="text" id="name" name="name" placeholder="Full Name" required>

            <input type="text" id="username" name="username" placeholder="Username" required>

            <input type="email" id="email" name="email" placeholder="Email" required>

            <input type="tel" id="number" name="phone" placeholder="Phone Number" maxlength="10" required>

            <input type="password" id="password" name="password" placeholder="Password"  required>

            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" minlength="8" required>

            <br>

            <div class="gender-buttons">
                <input class="radio" type="radio" name="gender" id="Male" value="Male" required>
                <label for="Male" class="gender-label">Male</label>
                <input class="radio" type="radio" name="gender" id="Female" value="Female" required>
                <label for="Female" class="gender-label">Female</label>
            </div>

            <br>

            <button type="submit" onclick="validateInput(event)">Register</button>
            <p id="error-message" style="font-size: xx-small;color: red;"><?php echo @$error_username_exists; ?></p>
            <p id="error-message" style="font-size: xx-small;color: red;"><?php echo @$error_password; ?></p>
        </form>
        <div class="register-link">
            <p>Already have an account?</p>
            <a href="login.php" class="register-button">Login</a>
        </div>
    </div>

    <div class="footer">
        © 2024 Bracken. All rights reserved.
    </div>
</body>
    <script>
        document.querySelector('.burger-menu').addEventListener('click', function () {
            document.querySelector('.menu-links').classList.toggle('active');
        });
    </script>
    <script src="js/RegistrationValidation.js"></script>
</html>
