<?php
@include 'config.php';

// Handle Delete from Cart
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$id'");
    header('location:cart.php');
}

// Fetch all items in the cart
$cart_items = mysqli_query($conn, "SELECT * FROM cart");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="cart.css">
   <link rel="stylesheet" href="user.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">
        <a href="user_page.php">MyShop</a>
    </div>
    <div class="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search products..." required>
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
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

<!-- Cart Container -->
<div class="container">

   <!-- Display Cart Items -->
   <div class="product-display">
      <table class="product-display-table">
         <thead>
            <tr>
               <th>Product Image</th>
               <th>Product Name</th>
               <th>Product Price</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
         <?php while($row = mysqli_fetch_assoc($cart_items)){ ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
               <td><?php echo $row['name']; ?></td>
               <td>$<?php echo $row['price']; ?>/-</td>
               <td>
                  <!-- Delete Button -->
                  <a href="cart.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Delete </a>
                  
                  <!-- Buy Button -->
                  <a href="checkout.php?product_id=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-shopping-cart"></i> Buy </a>
               </td>
            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>

</div>

</body>
</html>
