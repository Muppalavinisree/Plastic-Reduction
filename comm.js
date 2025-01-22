// DOM Elements
const postContainer = document.getElementById("postContainer");
const postButton = document.getElementById("postButton");

// Event Listener for Post Button
postButton.addEventListener("click", createPost);

// Function to Create a New Post
function createPost() {
    const name = document.getElementById("name").value;
    const content = document.getElementById("content").value;
    const fileInput = document.getElementById("fileInput").files[0];

    if (!name || !content) {
        alert("Name and post content are required!");
        return;
    }

    const formData = new FormData();
    formData.append("name", name);
    formData.append("content", content);
    if (fileInput) formData.append("file", fileInput);

    fetch("save_post.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                loadPosts();
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Error while creating the post.");
        });
}

// Function to Load Posts
function loadPosts() {
    fetch("fetch_post.php")
        .then((response) => response.json())
        .then((posts) => {
            postContainer.innerHTML = "";
            posts.forEach((post) => {
                const postElement = document.createElement("div");
                postElement.classList.add("post");

                postElement.innerHTML = `
                    <div class="post-header">${post.name}</div>
                    <div class="post-body">${post.content}</div>
                    ${
                        post.file_path
                            ? `<div class="post-media">
                                ${
                                    post.file_type.startsWith("image")
                                        ? `<img src="${post.file_path}" alt="Post Media" />`
                                        : `<video controls><source src="${post.file_path}" type="${post.file_type}"></video>`
                                }
                            </div>`
                            : ""
                    }
                    <div class="reactions">
                        <button class="like">❤ Like (${post.likes || 0})</button>
                        <button class="dislike">👎 Dislike (${post.dislikes || 0})</button>
                    </div>
                    <div class="comments-section">
                        <textarea placeholder="Add a comment..."></textarea>
                        <button class="add-comment">Add Comment</button>
                        <div class="comments">
                            ${post.comments
                                .map(
                                    (comment) => `
                                <div>
                                    ${comment.comment_text}
                                    <button class="edit-comment">Edit</button>
                                    <button class="delete-comment">Delete</button>
                                </div>
                            `
                                )
                                .join("")}
                        </div>
                    </div>
                `;

                // Add Event Listeners for Like and Dislike Buttons
                postElement.querySelector(".like").addEventListener("click", () => updateReaction(post.id, "like"));
                postElement.querySelector(".dislike").addEventListener("click", () => updateReaction(post.id, "dislike"));

                // Add Comment Functionality
                const addCommentBtn = postElement.querySelector(".add-comment");
                const commentsSection = postElement.querySelector(".comments");
                addCommentBtn.addEventListener("click", () => addComment(post.id, commentsSection));

                postContainer.appendChild(postElement);
            });
        });
}

// Update Reaction (Like/Dislike)
function updateReaction(postId, action) {
    fetch("update_reaction.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `post_id=${postId}&action=${action}`,
    })
        .then(loadPosts)
        .catch((error) => console.error("Error updating reaction:", error));
}

// Add Comment
function addComment(postId, commentsSection) {
    const commentText = commentsSection.parentNode.querySelector("textarea").value;
    if (!commentText) return;

    fetch("add_comment.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `post_id=${postId}&comment=${encodeURIComponent(commentText)}`,
    })
        .then(loadPosts)
        .catch((error) => console.error("Error adding comment:", error));
}

// Load posts on page load
window.addEventListener("load", loadPosts);
