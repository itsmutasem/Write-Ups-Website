<?php
session_start();
if ($_SESSION['loggedin'] !== true) {
    header('Location: login.php');
}

$old_email = $_SESSION['email'];
$username = $_SESSION['username'];
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bracken', 'root', '');
if (isset($_POST['current-email']) && isset($_POST['new-email']) && isset($_POST['confirm-email'])){
    $current_email = $_POST['current-email'];
    $new_email = $_POST['new-email'];
    $confirm_email = $_POST['confirm-email'];
    if ($old_email != $current_email){
        $current_email_wrong = 'Current email is wrong';
    }
    if ($new_email != $confirm_email){
        $emails_do_not_match = 'Emails do not match';
    }
    if ($old_email == $current_email && $new_email == $confirm_email){
        $sql = "UPDATE users SET email = :email
            WHERE username = '$username'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':email' => $new_email));
        $_SESSION['email'] = $new_email;
        header('Location: profile.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Email</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="css/ChangEmail.css" rel="stylesheet">
</head>

<body>
<div class="login-container">
    <h1>Change Email</h1>
    <form id="change-email-form" method="post">
        <input type="email" id="current-email" name="current-email" placeholder="Current Email" required>
        <input type="email" id="new-email" name="new-email" placeholder="New Email" required>
        <input type="email" id="confirm-email" name="confirm-email" placeholder="Confirm New Email" required>
        <button type="submit">Save Changes</button>
    </form>
    <button id="go-back" onclick="window.location.href='profile.php'">Go Back</button>
    <?php echo @$current_email_wrong?>
    <?php echo @$emails_do_not_match?>
</div>
</body>

</html>
