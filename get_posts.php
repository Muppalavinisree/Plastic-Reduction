<?php
$conn = new mysqli("localhost", "root", "-Ixjv9Ab!gbk49vn", "social_platform");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $post_id = $row['id'];
        $comments = $conn->query("SELECT * FROM comments WHERE post_id = $post_id")->fetch_all(MYSQLI_ASSOC);
        $row['comments'] = $comments;
        $posts[] = $row;
    }
    echo json_encode($posts);
} else {
    echo json_encode([]);
}

$conn->close();
?>

