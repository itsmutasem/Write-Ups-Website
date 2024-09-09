<?php
session_start();
if ($_SESSION['loggedin'] !== true) {
    header('Location: writeup.php');
}
if ($_SESSION['admin'] !== true) {
    header('Location: writeup.php');
}
// Database connection
$conn = mysqli_connect("localhost", "root", "", "bracken");

if(isset($_POST["submit"])){
    $title = $_POST["title"];
    $link = $_POST["link"];
    $name = $_SESSION['name'];
    if($_FILES["image"]["error"] == 4){
        echo "<script> alert('Image Does Not Exist'); </script>";
    }
    else{
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)){
            echo "<script> alert('Invalid Image Extension'); </script>";
        }
        else if($fileSize > 1000000){
            echo "<script> alert('Image Size Is Too Large'); </script>";
        }
        else{
            $newImageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, 'img/' . $newImageName);

            // Prepare an SQL statement
            $stmt = $conn->prepare("INSERT INTO writeup (name, title, link, picture) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $title, $link, $newImageName);

            if ($stmt->execute()) {
                echo "<script> alert('Successfully Added'); document.location.href = 'writeups.php'; </script>";
            } else {
                echo "<script> alert('Database error: Could not insert data.'); </script>";
            }

            $stmt->close();
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
</head>
<body>
<h1>Add write up</h1>
<form action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <label for="title">Title: </label>
    <input type="text" name="title" id="title" required> <br>
    <label for="link">Link: </label>
    <input type="text" name="link" id="link" required> <br>
    <label for="image">Image: </label>
    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required> <br> <br>
    <button type="submit" name="submit">Submit</button>
</form>
<br>
<a href="mutasem_host.php">Back to write ups page</a>
</body>
</html>
