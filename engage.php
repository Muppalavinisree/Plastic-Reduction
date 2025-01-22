<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Platform</title>
    <link rel="stylesheet" href="engage.css">
</head>
<body>
    <div class="container">
        <h1>Community Platform</h1>
        <form id="postForm" class="post-form" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="4" required></textarea><br><br>

            <label for="file">Choose Image or Video:</label><br>
            <input type="file" id="file" name="file" accept="image/*,video/*"><br><br>

            <button type="submit">Post</button>
        </form>

        <hr>

        <div id="postsContainer">
            <!-- Posts will be displayed here -->
            <hr>
        </div>
        
    </div>

    <script src="engage.js"></script>
</body>
</html>
