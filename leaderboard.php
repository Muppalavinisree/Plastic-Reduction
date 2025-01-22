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

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Query to get the top 10 posts from the monthly challenge
$challengeSql = "SELECT p.id, p.name, p.content, p.file_path, mc.likes
                 FROM monthly_challenge mc
                 JOIN posts p ON mc.post_id = p.id
                 WHERE mc.month = ? AND mc.year = ?
                 ORDER BY mc.likes DESC
                 LIMIT 10";  // Top 10 leaderboard

$stmt = $conn->prepare($challengeSql);
$stmt->bind_param("ii", $currentMonth, $currentYear);
$stmt->execute();
$results = $stmt->get_result();

// Check if there are any posts
if ($results->num_rows > 0) {
    // Loop through the results and display each post
    while ($row = $results->fetch_assoc()) {
        echo "<div class='leaderboard-post'>
                <h3>{$row['name']}</h3>
                <p>{$row['content']}</p>
                <img src='{$row['file_path']}' alt='Video' style='max-width: 100%; height: auto;'>
                <p>Likes: {$row['likes']}</p>
              </div>";
    }
} else {
    echo "<p>No posts found for the current monthly challenge.</p>";
}

$stmt->close();
$conn->close();
?>
