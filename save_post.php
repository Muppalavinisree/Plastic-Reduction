<?php
$servername = "localhost";
$username = "root";
$password = "-Ixjv9Ab!gbk49vn";
$dbname = "community_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$content = $_POST['content'];
$file = $_FILES['file'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($file["name"]);
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Validate file type
$allowed_types = ['jpg', 'jpeg', 'png', 'mp4', 'webm', 'ogg'];
if (in_array($file_type, $allowed_types)) {
    move_uploaded_file($file["tmp_name"], $target_file);
    $sql = "INSERT INTO posts (name, content, file_path) VALUES ('$name', '$content', '$target_file')";
    if ($conn->query($sql) === true) {
        echo "Post saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Unsupported file type. Please upload an image or video.";
}

$conn->close();
?>
