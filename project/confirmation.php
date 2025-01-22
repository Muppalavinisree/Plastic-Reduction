<?php
@include 'config.php';

// Retrieve the data passed from the previous page (POST)
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$payment_method = $_POST['payment_method'];


// Insert into orders table
$insert_order = mysqli_query($conn, "INSERT INTO orders (product_id, product_name, product_price, product_image) 
                                      VALUES ('$product_id', '$product_name', '$product_price', '$product_image')");

if ($insert_order) {
    echo "<script>alert('Order confirmed successfully!');</script>";
} else {
    // Display error message
    echo "<script>alert('Failed to confirm order: " . mysqli_error($conn) . "');</script>";
}
?>

        

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="confirmation.css">
</head>
<body>

<!-- Navbar -->
<nav>
    Order Confirmation
</nav>


<!-- Confirmation Container -->
<div class="confirmation-container">
    <h2>Thank You for Your Order!</h2>

    <p>Your order has been successfully placed. Below are the details of your order:</p>

    <!-- Order Details -->
    <div class="order-details">
        <h3>Shipping Information</h3>
        <p>Name: <?php echo $name; ?></p>
        <p>Address: <?php echo $address; ?></p>
        <p>Phone: <?php echo $phone; ?></p>

        <h3>Product Information</h3>
        <p>Product Name: <?php echo $product_name; ?></p>
        <p>Price: $<?php echo $product_price; ?>/-</p>
        <p>Image: <img src="uploaded_img/<?php echo $product_image; ?>" height="100" alt=""></p>

        <h3>Payment Method</h3>
        <p>Selected Payment Method: <?php echo $payment_method; ?></p>
    </div>

    <!-- Thank You Message -->
    <div class="thank-you-message">
        <h3>Your payment is being processed. You will receive a confirmation email shortly.</h3>
    </div>
   

    <!-- Button to go back to the home page -->
    <div class="home-button">
        <a href="user_page.php"><button>Return to Home</button></a>
    </div>
</div>



</body>
</html>
