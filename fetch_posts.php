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

// Fetch all posts
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

$posts = [];
while ($row = $result->fetch_assoc()) {
    $post_id = $row['id'];

    // Fetch all comments related to this post
    $comments_result = $conn->query("SELECT * FROM comments WHERE post_id = $post_id");
    $comments = [];
    while ($comment_row = $comments_result->fetch_assoc()) {
        $comments[] = [
            'id' => $comment_row['id'],
            'comment_text' => $comment_row['comment_text'],
            'created_at' => $comment_row['created_at']
        ];
    }

    // Attach the comments to the post
    $row['comments'] = $comments;

    // Add the post with its comments to the posts array
    $posts[] = $row;
}

// Return the posts with comments as JSON
echo json_encode($posts);

$conn->close();
?>
