<?php
// Database connection
$servername = "localhost";
$username = "root";  // replace with your DB username
$password = "-Ixjv9Ab!gbk49vn";      // replace with your DB password
$dbname = "plastic_swap_marketplace";  // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];  // Get the item_id sent from the frontend
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Ensure item_id is provided
    if (empty($item_id)) {
        echo "Error: Item ID is missing.";
        exit;
    }

    // SQL query to insert the contact message into the 'messages' table
    $sql = "INSERT INTO messages (item_id, name, email, phone, message)
            VALUES ('$item_id', '$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === true) {
        // Send email to the item owner
        $item_sql = "SELECT contact FROM items WHERE id = $item_id";
        $result = $conn->query($item_sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ownerEmail = $row['contact'];

            // Email content
            $subject = "New Message About Your Item: $item_id";
            $body = "You have received a new message from $name.\n\nMessage: $message\n\nContact Info: $email, $phone";
            $headers = "From: no-reply@plasticswap.com";

            // Send the email
            mail($ownerEmail, $subject, $body, $headers);
            echo "Message sent successfully!";
        } else {
            echo "Error: Item not found in the database.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

