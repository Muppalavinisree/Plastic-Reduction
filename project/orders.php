
<?php
@include 'config.php';

// Fetch all orders that are not canceled
$orders_query = mysqli_query($conn, "SELECT * FROM orders WHERE status != 'Canceled'");
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Orders</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="user.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">
        <a href="user_page.php">MyShop</a>
    </div>
    <div class="cart-icon">
        <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
    </div>
    <div class="orders-icon">
        <a href="orders.php"><i class="fas fa-box"></i> Orders</a>
    </div>

    <div class="navbar-select">
        <form action="" method="GET">
            <select name="page" onchange="window.location.href=this.value;">
                <!-- Adjust the href values to point to pages outside the project folder -->
           
            <option value="../srp.php">Home</option>
            <option value="../aboutplastic.php">About</option>
            <option value="../videos.php">Videos</option>
            <option value="../solution.php">solutions</option>
            <option value="user_page.php">MyShop</option>
            <option value="../community.php">Community</option>
            <option value="../contactus.php">Contact Us</option>
            </select>
        </form>
    </div>
</nav>

<div class="container">
   <h2>My Orders</h2>

   <!-- Display Orders -->
   <div class="orders-display">
      <table class="orders-display-table">
         <thead>
            <tr>
               <th>Product Image</th>
               <th>Product Name</th>
               <th>Product Price</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
         <?php while($row = mysqli_fetch_assoc($orders_query)){ ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
               <td><?php echo $row['product_name']; ?></td>
               <td>₹<?php echo $row['product_price']; ?>/-</td>
               <td><?php echo $row['status']; ?></td>
               <td>
                  <!-- Optionally add cancel order functionality -->
                  <a href="cancelorder.php?order_id=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-times"></i> Cancel </a>
               </td>
            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>
</div>

</body>
</html>
