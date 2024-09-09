<?php
session_start();
$username = $_SESSION['username'];
if ($_SESSION['loggedin'] !== true) {
    header('Location: login.php');
}
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$gender = $_SESSION['gender'];
// database connection
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bracken', 'root', '');
// old data for print it in the box for edit
$select = $pdo->query("SELECT * FROM users WHERE username = '$username'");
$row = $select->fetch(PDO::FETCH_ASSOC);
$old_username = $row['username'];
$old_name = $row['name'];
$old_email = $row['email'];
$old_phone = $row['phone'];
// Check if all required fields are set
    if (isset($_POST['name']) && isset($_POST['username'])
        && isset($_POST['phone'])) {
        // Check if the username already exists in the database
        $username_check = strtolower($_POST['username']);
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':username' => $username_check));
        // If username exists, show an error message
        if ($_POST['username'] != $old_username){
            if ($stmt->rowCount() > 0) {
                $error_username_exists = "Username already exists. Please choose another one.";
                echo "<script> alert('$error_username_exists'); </script>";
            } else {
                $sql = "UPDATE users SET username = :username, name = :name, phone = :phone
                WHERE username = '$username'";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':username' => $_POST['username'],
                    ':name' => $_POST['name'],
                    ':phone' => $_POST['phone']));
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['phone'] = $_POST['phone'];
                $username = $_SESSION['username'];
                $name = $_SESSION['name'];
                $phone = $_SESSION['phone'];
                header('Location: profile.php');
            }
        }
        if ($_POST['username'] == $old_username) {
            // Edit
            $sql = "UPDATE users SET username = :username, name = :name, phone = :phone
            WHERE username = '$username'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':username' => $username,
                ':name' => $_POST['name'],
                ':phone' => $_POST['phone']));
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['phone'] = $_POST['phone'];
            $username = $_SESSION['username'];
            $name = $_SESSION['name'];
            $phone = $_SESSION['phone'];
            header('Location: profile.php');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
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

    <div class="profile-container">
        <?php
        if (@$gender == 'Male'){
            echo "<div class=\"profile-photo\" id=\"profile-photo\" style=\"background-image: url('img/profile/male.png');\"></div>";
        }
        else{
            echo "<div class=\"profile-photo\" id=\"profile-photo\" style=\"background-image: url('img/profile/female.png');\"></div>";
        }
        ?>
        <div class="profile-info">
            <h2 id="username"><?php echo @$old_username ?></h2>
            <h3 id="name"><?php echo @$old_name ?></h3>
            <!-- <p id="bio">This is a short bio.</p> -->
        </div>
        <button class="edit-button" id="edit-button">Edit</button>
        <a href="logout.php"><button  name="logout" class="logout-button" id="logout-button">Logout</button></a>
    </div>

    <div class="modal" id="edit-modal">
        <div class="modal-content">
            <form method="post">
                <span class="modal-close" id="modal-close">&times;</span>
                <h2>Edit Profile</h2>
                <input type="text" name="name" id="edit-name" placeholder="Full Name" value="<?php echo $old_name?>" required>
                <input type="text" name="username" id="edit-username" placeholder="Username" value="<?php echo $old_username?>" required>
                <!-- <input type="text" name="edit-bio" id="edit-bio" placeholder="Bio"> -->
                <input type="tel" name="phone" id="edit-phone" placeholder="Phone Number" value="<?php echo $old_phone?>" required>
                <button type="button" onclick="location.href='changemail.php'">Edit Email</button>
                <button type="button" onclick="location.href='changepass.php'">Edit Password</button>
                <button type="submit" name="save" value="Save" id="save-button" class="save-button">Save</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        © 2024 Bracken. All rights reserved.
    </footer>

    <script>
        document.querySelector('.burger-menu').addEventListener('click', function () {
            document.querySelector('.menu-links').classList.toggle('active');
        });

        // Modal functionality
        const editButton = document.getElementById('edit-button');
        const editModal = document.getElementById('edit-modal');
        const closeModal = document.getElementById('modal-close');
        const saveButton = document.getElementById('save-button');

        let gender = 'male'; // Assume gender is set by the server and can't be changed

        const profilePhoto = document.getElementById('profile-photo');
        const profilePics = {
            male: 'img/profile/male-profile-picture.jpg',
            female: 'img/profile/female-profile-picture.jpg'
        };

        editButton.addEventListener('click', () => {
            editModal.style.display = 'flex';
        });

        closeModal.addEventListener('click', () => {
            editModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == editModal) {
                editModal.style.display = 'none';
            }
        });
    </script>
</body>

</html>
