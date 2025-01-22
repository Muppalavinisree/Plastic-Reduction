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
$currentMonth = date("m");
$currentYear = date("Y");

// Calculate the last month and year
$lastMonth = $currentMonth - 1;
$lastYear = $currentYear;

// If the current month is January, set last month to December of the previous year
if ($lastMonth < 1) {
    $lastMonth = 12;
    $lastYear = $currentYear - 1;
}

// Update the status of the previous month's challenge to 'completed'
$sql = "UPDATE monthly_challenge SET status = 'completed' WHERE month = ? AND year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $lastMonth, $lastYear);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Monthly challenge status updated to 'completed'.";
} else {
    echo "No monthly challenge found for the last month.";
}

$stmt->close();
$conn->close();
?>
