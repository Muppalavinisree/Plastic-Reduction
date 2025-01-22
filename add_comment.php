<?php
$servername = "localhost";
$username = "root";
$password = "-Ixjv9Ab!gbk49vn";
$dbname = "community_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the required data is received
if (!isset($_POST['post_id']) || !isset($_POST['comment_text'])) {
    echo json_encode(["status" => "error", "message" => "Post ID and comment are required!"]);
    exit;
}

// Get the post ID and comment text from the form submission
$post_id = $_POST['post_id'];
$comment_text = $_POST['comment_text'];

// Validate inputs
if (empty($post_id) || empty($comment_text)) {
    echo json_encode(["status" => "error", "message" => "Post ID and comment are required!"]);
    exit;
}

// Sanitize input to prevent SQL injection
$post_id = intval($post_id); // Ensure it's an integer
$comment_text = $conn->real_escape_string($comment_text); // Escape any special characters

// Insert comment into the database
$sql = "INSERT INTO comments (post_id, comment_text) VALUES ($post_id, '$comment_text')";

if ($conn->query($sql) === true) {
    echo json_encode(["status" => "success", "message" => "Comment added successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

// Close the connection
$conn->close();
?>
