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

// Ensure the required data is received
if (!isset($_POST['comment_id'])) {
    echo json_encode(["status" => "error", "message" => "Comment ID is required!"]);
    exit;
}

// Get the comment ID
$comment_id = $_POST['comment_id'];

// Sanitize input to prevent SQL injection
$comment_id = intval($comment_id); // Ensure it's an integer

// Delete comment from the database
$sql = "DELETE FROM comments WHERE id = $comment_id";

if ($conn->query($sql) === true) {
    echo json_encode(["status" => "success", "message" => "Comment deleted successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
