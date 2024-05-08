<?php

@include 'connect.php';


if(isset($_POST['add_product'])){

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_description=$_POST['description'];
$product_category=$_POST['category'];
$product_image = $_FILES['product_image']['name'];
$product_image_tmp_name = $_FILES['product_image']['tmp_name'];

$product_image_folder = 'Addproduct/'.$product_image;

if(empty($product_name) || empty($product_price) || empty($product_image)){
   $message[] = 'please fill out all';
}else{
   $insert = "INSERT INTO admin(img_dir,name, description,price,category) VALUES('$product_image','$product_name', '$product_description','$product_price', '$category')";
   $upload = mysqli_query($con,$insert);
   if($upload){
      move_uploaded_file($product_image_tmp_name, $product_image_folder);
      $message[] = 'new product added successfully';
   }else{
      $message[] = 'could not add the product';
   }
}

};

if(isset($_GET['delete'])){
$id = $_GET['delete'];
mysqli_query($con, "DELETE FROM admin WHERE id = $id");
header('location:Admin.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin page</title>


<link rel="stylesheet" href="css/Admin.css">


</head>
<body>

<?php

if(isset($message)){
foreach($message as $message){
   echo '<span class="message">'.$message.'</span>';
}
}

?>

<div class="container">

<div class="admin-product-form-container">
<h2>Admin Panel</h2>
   <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
  
      <h3>Add a new product</h3>
      <input type="text" placeholder="Enter product name" name="product_name" class="box">
      <input type="text" placeholder="Enter product description" name="description" class="box">
      <input type="" placeholder="Enter product price" name="product_price" class="box">
      <input type="text" placeholder="Enter category" name="product_price" class="box">
      <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
      <input type="submit" class="btn" name="add_product" value="add product">
   </form>

</div>

<?php

$select = mysqli_query($con, "SELECT * FROM admin");

?>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
         <th>product image</th>
         <th>product name</th>
         <th>product description</th>
         <th>product price</th>
         
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
      <tr>
         <td><img src="Addproduct/<?php echo $row['img_dir']; ?>" height="150" alt="Jwellery"></td>
         <td><?php echo $row['name']; ?></td>
         <td><?php echo $row['description']; ?></td>
         <td>Rs<?php echo $row['price']; ?>/-</td>
         
         
           
            <a href="Admin.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Product insert table</a>
         </td>
      </tr>
   <?php } ?>
   </table>
</div>

</div>
<h3>Order Table</h3>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
         <th>product image</th>
         <th>product name</th>
         <th>customer_id</th>
        <th>product price</th>
         <th>product weight</th>
         
      </tr>
      </thead>
<?php

            $select_query = "SELECT * FROM `orders` ORDER BY id ASC";
            $result = mysqli_query($con, $select_query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                   
                        ?>
                        <table class="product-display-table">
    <tr>
        <td><img src="<?php echo $row["product_image"]; ?>" alt="" width="150" height="150"></td>
        <td><strong><?php echo $row["product_name"]; ?></strong></td>
        <td><strong>Customer ID:</strong> <?php echo $row["customer_id"]; ?></td>
        <td><strong>Price:</strong> Rs <?php echo $row["product_price"]; ?></td>
        <td><strong>Weight:</strong> <?php echo $row["weight"]; ?> gms</td>
    </tr>
</table>
            <?php
                    }
                }
            
            ?>


</body>
</html>
