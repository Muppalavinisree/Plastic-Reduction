<?php
$host = "localhost";
$user = "root";
$password = '-Ixjv9Ab!gbk49vn';  // Correct password
$dbname = "login";   // Replace with your actual database name

// Establish a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Failed to connect DB: " . $conn->connect_error);
}
echo "Connected successfully";
?>


