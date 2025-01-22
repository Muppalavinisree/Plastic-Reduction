<?php
@include 'config.php'; // Include your database connection

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); // Sanitize the input to avoid SQL injection

    // Update the order status to 'Canceled'
    $cancel_query = mysqli_query($conn, "UPDATE orders SET status = 'Canceled' WHERE id = $order_id");

    if ($cancel_query) {
        echo "<script>alert('Order canceled successfully!');</script>";
// Redirect to the orders page
        exit;
    } else {
        echo "<script>alert('Failed to cancel the order. Please try again.');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
    header('Location: orders.php'); // Redirect if no order_id is provided
    exit;
}
?>

