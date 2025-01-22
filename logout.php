<?php
session_start(); // Start session
session_destroy(); // Destroy session
header("Location: srp.php"); // Redirect to login page
exit();
?>
