<?php
@include 'config.php';

$products = [];

if (isset($_GET['query'])) {
    // Sanitize the search query
    $query = mysqli_real_escape_string($conn, $_GET['query']);

    // Perform search on product name or description
    $search_query = "SELECT * FROM products WHERE name LIKE '%$query%' ";
    $result = mysqli_query($conn, $search_query);

    // Check if the query was successful
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));  // Handle query failure
    }

    if (mysqli_num_rows($result) > 0) {
        // Fetch matching products
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $products = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Results</title>
   <link rel="stylesheet" href="user.css">
</head>
<body>
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
   <h2>Search Results for "<?php echo htmlspecialchars($_GET['query']); ?>"</h2>

   <?php if (!empty($products)): ?>
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
               <?php foreach ($products as $product): ?>
                  <tr>
                     <td><img src="uploaded_img/<?php echo $product['image']; ?>" height="100" alt=""></td>
                     <td><?php echo $product['name']; ?></td>
                     <td>$<?php echo $product['price']; ?>/-</td>
                     <td>
                        <a href="user_page.php?add=<?php echo $product['id']; ?>" class="btn">Add to Cart</a>
                        <a href="checkout.php?product_id=<?php echo $product['id']; ?>" class="btn">Buy</a>
                     </td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   <?php else: ?>
      <p>No products found matching your search.</p>
   <?php endif; ?>
</div>

</body>
</html>
