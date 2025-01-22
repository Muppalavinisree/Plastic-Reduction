<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Platform</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        .navbar .menu-links {
            display: flex;
            list-style: none;
        }
        .navbar .menu-links li {
            margin: 0 15px;
        }
        .navbar .menu-links a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
        }
        .navbar .menu-links a:hover {
            color: #ddd;
        }
        .navbar .material-symbols-outlined {
            display: none;
            font-size: 30px;
            cursor: pointer;
        }
        #menu-btn {
            display: block;
        }
        #close-menu-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .navbar .menu-links {
                position: absolute;
                top: 50px;
                right: 0;
                background-color: #333;
                width: 200px;
                height: 100vh;
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 20px;
                display: none;
            }
            .navbar .menu-links li {
                margin: 10px 0;
            }
            .navbar .menu-links.active {
                display: block;
            }
            .navbar .material-symbols-outlined {
                display: block;
            }
            #menu-btn {
                display: block;
            }
           
        }

        /* New section for message */
        .message-box {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            font-size: 16px;
            text-align: center;
        }
        #postForm {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px;
        }
        #postForm input, #postForm textarea, #postForm button {
            width: 100%;
            max-width: 400px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        #postForm textarea {
            height: 150px;
        }
        #postForm button {
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        #postForm button:hover {
            background-color: #444;
        }

        /* Styling for horizontal line */
      .post-divider {
          border: 0;
          border-top: 3px solid black;
           margin: 20px 0;
}


    </style>
</head>


    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <a href="#" class="logo">plastic<span>.</span></a>
            <ul class="menu-links">
                <span id="close-menu-btn" class="material-symbols-outlined">close</span>
                <li><a href="srp.php">Home</a></li>
                <li><a href="aboutplastic.php">About</a></li>
                <li><a href="videos.php">Videos</a></li>
                <li><a href="solution.php">Solution</a></li>
                <li><a href="community.php">Community</a></li>
                <li><a href="project/user_page.php">MyShop</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li><a href="index.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Message Box -->
    <div class="message-box">
        <p>If you have uploaded more than 10 videos,got more than 500 likes, or collected 100kg of plastic, please contact us via the <a href="contactus.php" style="color: #007bff;">Contact Us</a> page. You will be awarded a 5% discount in <a href="project/user_page.php" style="color: #007bff;">My Shop</a></p>
    </div>

    <h1>Social Platform</h1>
    <form id="postForm">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <textarea name="content" placeholder="Post Content" required></textarea><br>
        <input type="file" name="file" required><br>
        <button type="submit">Post</button>
    </form>

    <div id="posts"></div>



    <script>
        // Save Post
        $("#postForm").on("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: "save_post.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response);
                    $("#postForm")[0].reset();
                    loadPosts();
                }
            });
        });

        // Load Posts
        function loadPosts() {
            $.get("fetch_posts.php", function (data) {
                const posts = JSON.parse(data);
                $("#posts").html("");
                posts.forEach((post) => {
                    let media = "";
                    const fileExtension = post.file_path.split(".").pop().toLowerCase();
                    if (["mp4", "webm", "ogg"].includes(fileExtension)) {
                        media = `<video width="300" controls>
                                    <source src="${post.file_path}" type="video/${fileExtension}">
                                    Your browser does not support the video tag.
                                 </video>`;
                    } else if (["jpg", "jpeg", "png"].includes(fileExtension)) {
                        media = `<img src="${post.file_path}" alt="Uploaded file" width="300">`;
                    }

                    // Render comments with edit and delete buttons
                    const comments = post.comments.map(comment => `
                        <div class="comment" data-id="${comment.id}">
                            <p class="comment-text">${comment.comment_text}</p>
                            <input class="edit-comment" type="text" value="${comment.comment_text}" />
                            <button class="editCommentBtn">Edit</button>
                            <button class="deleteCommentBtn">Delete</button>
                        </div>
                    `).join(" ");

                    $("#posts").append(`
                        <div class="post" data-id="${post.id}">
                            <h3>${post.name}</h3>
                            <p>${post.content}</p>
                            ${media}
                            <div>
                                <button class="likeBtn">Like (${post.likes})</button>
                                <button class="dislikeBtn">Dislike (${post.dislikes})</button>
                            </div>
                            <div class="comments">
                                ${comments}
                                <textarea class="commentInput" placeholder="Add a comment"></textarea>
                                <button class="commentBtn">Add Comment</button>
                            </div>
                        </div>
                        <hr class="post-divider" />
                    `);
                });
            });
        }

// Increment like
$(document).on("click", ".likeBtn", function () {
    const postId = $(this).closest(".post").data("id"); // Get the post ID
    const likeButton = $(this); // Store reference to the like button
    const dislikeButton = likeButton.next(".dislikeBtn"); // Get the corresponding dislike button

    $.post("update_likes.php", { post_id: postId, action: "like" }, function (response) {
        const result = JSON.parse(response); // Parse the response
        if (result.status === "success") {
            alert(result.message); // Success message
            likeButton.text(`Like (${result.likes})`); // Update like count on the button
            dislikeButton.text(`Dislike (${result.dislikes})`); // Update dislike count
        } else {
            alert(result.message); // Show error message if something went wrong
        }
    });
});

// Increment dislike
$(document).on("click", ".dislikeBtn", function () {
    const postId = $(this).closest(".post").data("id"); // Get the post ID
    const dislikeButton = $(this); // Store reference to the dislike button
    const likeButton = dislikeButton.prev(".likeBtn"); // Get the corresponding like button

    $.post("update_likes.php", { post_id: postId, action: "dislike" }, function (response) {
        const result = JSON.parse(response); // Parse the response
        if (result.status === "success") {
            alert(result.message); // Success message
            dislikeButton.text(`Dislike (${result.dislikes})`); // Update dislike count on the button
            likeButton.text(`Like (${result.likes})`); // Update like count
        } else {
            alert(result.message); // Show error message if something went wrong
        }
    });
});



        // Edit Comment Button
        $(document).on("click", ".editCommentBtn", function () {
            const commentDiv = $(this).closest(".comment");
            const commentId = commentDiv.data("id");
            const currentText = commentDiv.find(".comment-text").text();
            const editInput = commentDiv.find(".edit-comment");

            // Toggle visibility between edit input and text
            editInput.toggle();
            commentDiv.find(".comment-text").toggle();
            if (editInput.is(":visible")) {
                editInput.val(currentText); // Set the current comment text in the input
            } else {
                const newCommentText = editInput.val();
                // Update the comment in the backend
                $.post("edit_comment.php", { comment_id: commentId, new_comment_text: newCommentText }, function (response) {
                    const result = JSON.parse(response);
                    alert(result.message);
                    loadPosts(); // Reload posts to show the updated comment
                });
            }
        });

        // Delete Comment Button
        $(document).on("click", ".deleteCommentBtn", function () {
            const commentDiv = $(this).closest(".comment");
            const commentId = commentDiv.data("id");

            if (confirm("Are you sure you want to delete this comment?")) {
                $.post("delete_comment.php", { comment_id: commentId }, function (response) {
                    const result = JSON.parse(response);
                    alert(result.message);
                    commentDiv.remove(); // Remove the comment from the DOM
                });
            }
        });

        // Add Comment
        $(document).on("click", ".commentBtn", function () {
            const postId = $(this).closest(".post").data("id"); // Ensure this is the correct ID
            const commentText = $(this).prev(".commentInput").val(); // Get the comment text

            // Check if both postId and commentText are valid
            if (!postId || !commentText) {
                alert("Post ID and comment cannot be empty.");
                return;
            }

            $.post("add_comment.php", { post_id: postId, comment_text: commentText }, function (response) {
                const result = JSON.parse(response); // Parse the response

                if (result.status === "success") {
                    alert(result.message);  // Show success message
                    loadPosts(); // Reload posts to show the new comment
                } else {
                    alert(result.message);  // Show error message if something went wrong
                }
            });
        });

        loadPosts(); // Initial load of posts
    </script>
</body>
</html>
