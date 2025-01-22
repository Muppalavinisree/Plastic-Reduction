<?php
@include 'config.php';

// Handle Add to Cart
if (isset($_GET['add'])) {
    $product_id = $_GET['add'];

    // Fetch product details
    $product_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'");
    $product = mysqli_fetch_assoc($product_query);

    if ($product) {
        // Insert into cart
        $name = $product['name'];
        $price = $product['price'];
        $image = $product['image'];

        // Check if product already exists in cart
        $check_cart = mysqli_query($conn, "SELECT * FROM cart WHERE product_id = '$product_id'");
        if (mysqli_num_rows($check_cart) > 0) {
            echo "<script>alert('Product is already in the cart!');</script>";
        } else {
            mysqli_query($conn, "INSERT INTO cart (product_id, name, price, image) VALUES ('$product_id', '$name', '$price', '$image')");
            echo "<script>alert('Product added to cart successfully!');</script>";
        }
    }
}

// Fetch all products from the database
$select = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Page</title>

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
            <select name="page" onchange="window.location.href=this.value;" >
                <!-- Adjust the href values to point to pages outside the project folder -->
            <option value="" disabled selected>Select Page</option>
          
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

   <!-- Display Products -->
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
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
               <td><?php echo $row['name']; ?></td>
               <td>$<?php echo $row['price']; ?>/-</td>
               <td>
                  <a href="user_page.php?add=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-cart-plus"></i> Add to Cart </a>
                  <a href="checkout.php?product_id=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-shopping-cart"></i> Buy </a>
               </td>
            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>

</div>

</body>
</html>

