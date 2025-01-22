// DOM Elements
const postContainer = document.getElementById("postContainer");
const postButton = document.getElementById("postButton");

// Event Listeners
postButton.addEventListener("click", createPost);

// Function to Create a New Post
function createPost() {
  const name = document.getElementById("name").value;
  const postText = document.getElementById("postText").value;
  const fileInput = document.getElementById("fileInput").files[0];

  if (!name || !postText) {
    alert("Name and post content are required!");
    return;
  }

  // Create Post Element
  const post = document.createElement("div");
  post.classList.add("post");

  // Like and Dislike counters
  let likeCount = 0;
  let dislikeCount = 0;

  post.innerHTML = `
    <div class="post-header">${name}</div>
    <div class="post-body">${postText}</div>
    ${
      fileInput
        ? `<div class="post-media">
            ${
              fileInput.type.startsWith("image/")
                ? `<img src="${URL.createObjectURL(fileInput)}" alt="Post Image" />`
                : `<video controls><source src="${URL.createObjectURL(fileInput)}" type="${fileInput.type}"></video>`
            }
          </div>`
        : ""
    }
    <div class="reactions">
      <span class="like">❤ Like (${likeCount})</span>
      <span class="dislike">👎 Dislike (${dislikeCount})</span>
    </div>
    <div class="comments-section">
      <textarea placeholder="Add a comment..."></textarea>
      <button class="add-comment">Add Comment</button>
      <div class="comments"></div>
    </div>
  `;

  // Add Like Button Functionality
  const likeBtn = post.querySelector(".like");
  likeBtn.addEventListener("click", () => {
    likeCount++;
    likeBtn.textContent = `❤ Like (${likeCount})`; // Update like count
  });

  // Add Dislike Button Functionality
  const dislikeBtn = post.querySelector(".dislike");
  dislikeBtn.addEventListener("click", () => {
    dislikeCount++;
    dislikeBtn.textContent = `👎 Dislike (${dislikeCount})`; // Update dislike count
  });

  // Add Comment Functionality
  const addCommentBtn = post.querySelector(".add-comment");
  const commentsSection = post.querySelector(".comments");

  addCommentBtn.addEventListener("click", () => {
    const commentText = post.querySelector("textarea").value;
    if (!commentText) return;

    const comment = document.createElement("div");
    comment.innerHTML = `
      ${commentText}
      <button class="edit">Edit</button>
      <button class="delete">Delete</button>
    `;

    commentsSection.appendChild(comment);

    // Edit Comment
    comment.querySelector(".edit").addEventListener("click", () => {
      const newComment = prompt("Edit your comment:", commentText);
      if (newComment) comment.childNodes[0].textContent = newComment;
    });

    // Delete Comment
    comment.querySelector(".delete").addEventListener("click", () => {
      commentsSection.removeChild(comment);
    });

    post.querySelector("textarea").value = ""; // Clear text area
  });

  postContainer.appendChild(post);

  // Clear input fields after post
  document.getElementById("name").value = "";
  document.getElementById("postText").value = "";
  document.getElementById("fileInput").value = ""; // Clear file input
}

// Optionally, clear input fields on page load if there's no post
window.addEventListener("load", () => {
  document.getElementById("name").value = "";
  document.getElementById("postText").value = "";
  document.getElementById("fileInput").value = ""; // Clear file input on page reload
});
