<?php
$servername = "localhost";
$username = "root";
$password = "-Ixjv9Ab!gbk49vn";
$dbname = "community_platform";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the required parameters are passed
if (!isset($_POST['post_id']) || !isset($_POST['action'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    exit;
}

$post_id = $_POST['post_id'];
$action = $_POST['action'];

// Validate the action to ensure it is either 'like' or 'dislike'
if ($action !== 'like' && $action !== 'dislike') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    exit;
}

// Determine the column to update based on the action
$column = ($action == 'like') ? 'likes' : 'dislikes';

// Update the likes or dislikes in the database
$sql = "UPDATE posts SET $column = $column + 1 WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind the post_id to the prepared statement
$stmt->bind_param('i', $post_id);

// Execute the statement
if ($stmt->execute()) {
    // Get the updated like/dislike count
    $stmt->close(); // Close the statement after the execution
    $stmt = $conn->prepare("SELECT likes, dislikes FROM posts WHERE id = ?");
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Return the updated counts as a JSON response
    echo json_encode([
        'status' => 'success',
        'message' => 'Your response updated successfully',
        'likes' => $row['likes'],
        'dislikes' => $row['dislikes']
    ]);
} else {
    // Handle the case where the update fails
    echo json_encode(['status' => 'error', 'message' => 'Failed to update vote']);
}

// Close the database connection
$stmt->close();
$conn->close();
?>
