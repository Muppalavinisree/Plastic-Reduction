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
    $name = $_POST['itemName'];
    $description = $_POST['itemDescription'];
    $image = $_POST['itemImage'];  // You can handle image upload in another way
    $category = $_POST['itemCategory'];
    $contact = $_POST['itemContact'];

    // SQL query to insert the item details into the 'items' table
    $sql = "INSERT INTO items (name, description, image, category, contact)
            VALUES ('$name', '$description', '$image', '$category', '$contact')";

    if ($conn->query($sql) === true) {
        echo "New item posted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
