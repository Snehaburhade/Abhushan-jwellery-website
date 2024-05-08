<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jewellerywebsite";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_SESSION['user_id'])) {
} else {
    header("Location: login.php");
    exit;
}
if (!$conn) {
    echo "Failed to Connect";
}

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $productName = $_GET["name"];
    $deleteQuery = "DELETE FROM `orders` WHERE name = '$productName'";
    mysqli_query($conn, $deleteQuery);
}

$total = 0;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>
    <link rel="stylesheet" href="css/addtocart.css">
</head>

<body>
    <nav>
        <div></div>
    </nav>
    <h3>Cart</h3>
    <div class="table_container">
        <table>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>customer Id</th>
                <th>Product Price</th>
                <th>Weight</th>

            </tr>
            <?php
            $select_query = "SELECT * FROM `orders` ORDER BY id ASC";
            $result = mysqli_query($conn, $select_query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    if ($_SESSION['user_id'] == $row["customer_id"]) {
                        ?>
                        <tr>
                            <td><img src="<?php echo $row["product_image"]; ?>" alt="" width="250" height="250"></td>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["customer_id"]; ?></td>
                            <td>Rs <?php echo $row["product_price"]; ?></td>
                            <td><?php echo $row["weight"]; ?>gms</td>



                        </tr>
            <?php
                    }
                }
            }
            ?>
            <tr></tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>

            </tr>
        </table>
    </div>
    <footer></footer>
</body>

</html>