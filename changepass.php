<?php
session_start();
if ($_SESSION['loggedin'] !== true) {
    header('Location: login.php');
}
$username = $_SESSION['username'];

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bracken', 'root', '');

$old_password = $_SESSION['password'];
if (isset($_POST['current-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password'])){
    $current_password = md5($_POST['current-password']);
    $new_password = md5($_POST['new-password']);
    $confirm_password = md5($_POST['confirm-password']);
    if ($current_password != $old_password){
        $old_password_wrong = 'Current password is wrong';
    }
    if ($new_password != $confirm_password){
        $Passwords_do_not_match = 'Passwords do not match';
    }
    if ($old_password == $current_password && $new_password == $confirm_password){
        $sql = "UPDATE users SET password = :password
            WHERE username = '$username'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':password' => $new_password));
        $_SESSION['password'] = $new_password;
        header('Location: profile.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="css/ChangePass.css" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <h1>Change Password</h1>
        <form id="change-password-form" method="post">
            <input type="password" id="current-password" name="current-password" placeholder="Current Password" required>
            <input type="password" id="new-password" name="new-password" placeholder="New Password" required>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm New Password" required>
            <button type="submit">Save Changes</button>
        </form>
        <button id="go-back" onclick="window.location.href='profile.php'">Go Back</button>
        <?php echo @$old_password_wrong?>
        <?php echo @$Passwords_do_not_match?>
    </div>
</body>

</html>
