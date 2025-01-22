// Assuming userId and postId are obtained
$postId = $_POST['post_id']; // From request
$action = $_POST['action']; // Like or Dislike

// Query to check if the user has already reacted
$checkReactionQuery = "SELECT * FROM post_reactions WHERE user_id = ? AND post_id = ?";
$stmt = $community_conn->prepare($checkReactionQuery);
$stmt->bind_param("ii", $userId, $postId);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // If the user has already reacted, update the action
    $updateReactionQuery = "UPDATE post_reactions SET action = ? WHERE user_id = ? AND post_id = ?";
    $stmt = $community_conn->prepare($updateReactionQuery);
    $stmt->bind_param("sii", $action, $userId, $postId);
    $stmt->execute();
} else {
    // If not, insert a new reaction
    $insertReactionQuery = "INSERT INTO post_reactions (user_id, post_id, action) VALUES (?, ?, ?)";
    $stmt = $community_conn->prepare($insertReactionQuery);
    $stmt->bind_param("iis", $userId, $postId, $action);
    $stmt->execute();
}

// Update the post's likes or dislikes
if ($action === 'like') {
    $updatePostQuery = "UPDATE posts SET likes = likes + 1 WHERE id = ?";
} else {
    $updatePostQuery = "UPDATE posts SET dislikes = dislikes + 1 WHERE id = ?";
}
$stmt = $community_conn->prepare($updatePostQuery);
$stmt->bind_param("i", $postId);
$stmt->execute();

$stmt->close();
$community_conn->close();
