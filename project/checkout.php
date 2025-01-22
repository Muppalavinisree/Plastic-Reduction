<?php
@include 'config.php';

// Handle order confirmation
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details
    $product_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'");
    $product = mysqli_fetch_assoc($product_query);

    if ($product) {
        $name = $product['name'];
        $price = $product['price'];
        $image = $product['image'];

      
    } else {
        echo "<script>alert('Product not found.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="checkout.css">
</head>
<body>

<h2>Place Your Order</h2>

<form action="payment.php" method="post">
    <h3>Delivery Details</h3>
    <label for="name">Full Name:</label>
    <input type="text" name="name" required><br>
    
    <label for="address">Delivery Address:</label>
    <input type="text" name="address" required><br>
    
    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" required><br>

    <!-- Product Details -->
    <h3>Product Details</h3>
    <p>Name: <?php echo $product['name']; ?></p>
    <p>Price: $<?php echo $product['price']; ?>/-</p>
    <p>image: <img src="uploaded_img/<?php echo $product['image']; ?>" height="100" alt="">/-</p>
    
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
    
    <input type="submit" value="Proceed to Payment">
</form>

</body>
</html>
