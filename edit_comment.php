<?php
$servername = "localhost";
$username = "root";
$password = "-Ixjv9Ab!gbk49vn";
$dbname = "community_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['comment_id']) || !isset($_POST['new_comment_text'])) {
    echo json_encode(["status" => "error", "message" => "Comment ID and new comment text are required!"]);
    exit;
}

$comment_id = $_POST['comment_id'];
$new_comment_text = $_POST['new_comment_text'];

// Sanitize the input
$comment_id = intval($comment_id);
$new_comment_text = $conn->real_escape_string($new_comment_text);

// Update the comment in the database
$sql = "UPDATE comments SET comment_text = '$new_comment_text' WHERE id = $comment_id";

if ($conn->query($sql) === true) {
    echo json_encode(["status" => "success", "message" => "Comment updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error updating comment: " . $conn->error]);
}

$conn->close();
?>

