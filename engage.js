document.getElementById("postForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    showLoading(true);

    fetch("save_post.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.text())
        .then((data) => {
            alert(data);
            loadPosts();
            this.reset();
        })
        .catch((error) => console.error("Error:", error))
        .finally(() => showLoading(false));
});


function loadPosts() {
    fetch("fetch_post.php")
        .then((response) => response.json())
        .then((posts) => {
            const postsContainer = document.getElementById("postsContainer");
            postsContainer.innerHTML = "";

            posts.forEach((post) => {
                const postDiv = document.createElement("div");
                postDiv.className = "post";
                postDiv.id = `post-${post.id}`;

                const likeButton = `<button id="likeBtn-${post.id}" onclick="likePost(${post.id})">Like (${post.likes})</button>`;
                const dislikeButton = `<button id="dislikeBtn-${post.id}" onclick="dislikePost(${post.id})">Dislike (${post.dislikes})</button>`;
                const commentInput = `<input type="text" id="commentInput-${post.id}" placeholder="Add a comment..." required>`;
                const commentButton = `<button onclick="addComment(${post.id})">Add Comment</button>`;

                let commentsSection = "";
                if (post.comments && post.comments.length > 0) {
                    commentsSection = post.comments.map(comment => `
                        <div id="comment-${comment.id}" class="comment">
                            <p>${comment.comment_text}</p>
                            <button onclick="editComment(${comment.id})">Edit</button>
                            <button onclick="deleteComment(${comment.id})">Delete</button>
                        </div>
                    `).join('');
                }

                postDiv.innerHTML = `
                    <h3>${post.name}</h3>
                    <p>${post.content}</p>
                    ${
                        post.file_path
                            ? post.file_path.endsWith(".mp4")
                                ? `<video controls src="${post.file_path}"></video>`
                                : `<img src="${post.file_path}" alt="Post Image">`
                            : ""
                    }
                    <div class="actions">
                        ${likeButton}
                        ${dislikeButton}
                    </div>
                    <div class="comment-section">
                        ${commentsSection}
                        ${commentInput}
                        ${commentButton}
                    </div>
                `;

                postsContainer.appendChild(postDiv);
                const separator = document.createElement("hr");
                separator.className = "post-separator";
                postsContainer.appendChild(separator);
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an issue loading the posts.");
        });
}

function likePost(postId) {
    updateReaction(postId, "like");
}

function dislikePost(postId) {
    updateReaction(postId, "dislike");
}

function updateReaction(postId, action) {
    const likeBtn = document.getElementById(`likeBtn-${postId}`);
    const dislikeBtn = document.getElementById(`dislikeBtn-${postId}`);

    likeBtn.disabled = true;
    dislikeBtn.disabled = true;

    fetch("update_likes.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `post_id=${postId}&action=${action}`,
    })
        .then((response) => response.json())  // Assuming server returns updated post data
        .then((data) => {
            if (data.status === "Success") {
                updatePostUI(data.post);
            } else {
                console.error("Error:", data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        })
        .finally(() => {
            likeBtn.disabled = false;
            dislikeBtn.disabled = false;
        });
}



function addComment(postId) {
    const commentInput = document.getElementById(`commentInput-${postId}`);
    const commentText = commentInput.value.trim();

    if (commentText === "") {
        alert("Please enter a comment.");
        return;
    }

    fetch("add_comment.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `post_id=${postId}&comment=${commentText}`,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "Success") {
                commentInput.value = "";  // Clear the input
                loadPosts();  // Reload posts to reflect the new comment
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function editComment(commentId) {
    const newCommentText = prompt("Edit your comment:");

    if (newCommentText && newCommentText.trim() !== "") {
        fetch("edit_comment.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `comment_id=${commentId}&new_comment=${newCommentText}`,
        })
            .then((response) => response.text())
            .then((data) => {
                if (data.trim() === "Success") {
                    loadPosts();  // Reload posts to reflect updated comment
                } else {
                    console.error("Error:", data);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    } else {
        alert("Comment cannot be empty.");
    }
}

function deleteComment(commentId) {
    if (confirm("Are you sure you want to delete this comment?")) {
        fetch("delete_comment.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `comment_id=${commentId}`,
        })
            .then((response) => response.text())
            .then((data) => {
                if (data.trim() === "Success") {
                    loadPosts();  // Reload posts to remove deleted comment
                } else {
                    console.error("Error:", data);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
}

loadPosts();
