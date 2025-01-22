<?php
@include 'config.php';

// Get the data from the form (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $payment_method = $_POST['payment_method'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <link rel="stylesheet" href="shipping.css">
</head>
<body>


<!-- Navbar -->
<nav>
    Order Confirmation
</nav>


<!-- Order Confirmation Container -->
<div class="order-confirmation">
    <h2>Order Confirmation</h2>

    <!-- Order Details -->
    <div class="order-details">
        
        <!-- Shipping Information -->
        <div class="shipping-info">
            <h3>Shipping Information</h3>
            <p>Name: <?php echo $name; ?></p>
            <p>Address: <?php echo $address; ?></p>
            <p>Phone: <?php echo $phone; ?></p>
        </div>

        <!-- Product Details -->
        <div class="product-info">
            <h3>Product Details</h3>
            <p>Product Name: <?php echo $product_name; ?></p>
            <p>Price: $<?php echo $product_price; ?>/-</p>
            <p>Image: <img src="uploaded_img/<?php echo $product_image; ?>" height="100" alt=""></p>
        </div>

    </div>

    <!-- Payment Method -->
    <div class="payment-method">
        <h3>Payment Method</h3>
        <p>Selected Payment Method: <?php echo $payment_method; ?></p>
    </div>

    <!-- Confirm Order Form -->
    <form action="confirmation.php" method="post">
    <input type="hidden" name="name" value="<?php echo $name; ?>">
    <input type="hidden" name="address" value="<?php echo $address; ?>">
    <input type="hidden" name="phone" value="<?php echo $phone; ?>">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"> <!-- Ensure this is being passed -->
    <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
    <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
    <input type="hidden" name="product_image" value="<?php echo $product_image; ?>"> <!-- Ensure this is being passed -->
    <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>">

        <input type="submit" value="Pay Now">
    </form>
</div>

</body>
</html>
