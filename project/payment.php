<?php
@include 'config.php';

// Get the order details from the form (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <link rel="stylesheet" href="payment.css">
    <script>
        function changeFormAction() {
            var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            var form = document.getElementById('paymentForm');
            
            if (paymentMethod == 'Cash on Delivery') {
                // For COD, submit the form directly for order confirmation
                form.action = 'cashon.php'; // Redirect to confirmation.php for COD
            } else {
                // For other payment methods, proceed to shipping page
                form.action = 'shipping.php';
            }
        }
    </script>
</head>
<body>
    

<h2>Payment Method</h2>

<!-- Display Order and Delivery Details -->
<h3>Delivery Information</h3>
<p>Name: <?php echo $name; ?></p>
<p>Address: <?php echo $address; ?></p>
<p>Phone: <?php echo $phone; ?></p>

<!-- Display Product Details -->
<h3>Product Details</h3>
<p>Name: <?php echo $product_name; ?></p>
<p>Price: ₹<?php echo $product_price; ?>/-</p>
<p>Image: <img src="uploaded_img/<?php echo $product_image; ?>" height="100" alt=""></p>

<form id="paymentForm" action="shipping.php" method="post" onsubmit="changeFormAction()">
    <h3>Select Payment Method</h3>
    <input type="radio" name="payment_method" value="Credit Card" required> Credit Card<br>
    <input type="radio" name="payment_method" value="PayPal" required> PayPal<br>
    <input type="radio" name="payment_method" value="Cash on Delivery" required> Cash on Delivery<br>

    <!-- Hidden fields to pass the data -->
    <input type="hidden" name="name" value="<?php echo $name; ?>">
    <input type="hidden" name="address" value="<?php echo $address; ?>">
    <input type="hidden" name="phone" value="<?php echo $phone; ?>">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
    <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
    <input type="hidden" name="product_image" value="<?php echo $product_image; ?>">

    <input type="submit" value="Proceed to Shipping & Payment">
</form>

</body>
</html>
