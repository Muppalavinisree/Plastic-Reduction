<?php
@include 'config.php';

// Add Product functionality
if(isset($_POST['add_product'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'Please fill out all fields.';
   }else{
      // Insert the new product into the database
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn, $insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'New product added successfully!';
      }else{
         $message[] = 'Could not add the product.';
      }
   }
}

// Delete Product functionality
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
// Display messages (e.g., success or error)
if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}
?>

<div class="container">
   <!-- Add Product Form -->
   <div class="admin-product-form-container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add a New Product</h3>
         <input type="text" placeholder="Enter product name" name="product_name" class="box">
         <input type="number" placeholder="Enter product price" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="Add Product">
      </form>
   </div>

   <?php
   // Fetch all products from the database
   $select = mysqli_query($conn, "SELECT * FROM products");
   ?>

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
                  <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
                  <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this product?');"> <i class="fas fa-trash"></i> Delete </a>
               </td>
            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>

   <!-- Link to User Page -->
   <div class="go-to-user-page">
      <a href="user_page.php" class="btn">Go to User Page</a>
   </div>

</div>

</body>
</html>


