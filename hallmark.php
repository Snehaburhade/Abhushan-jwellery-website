<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "jewellerywebsite";

$conn = mysqli_connect($servername, $username, $password, $database);
if (isset($_SESSION['user_id'])) {
} else {
    header("Location: login.php");
    exit;
}

if (!$conn) {
    echo "Failed to Connect";
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, name, img_dir, weight, price FROM hallmarkgold";



$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hallmark Gold</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: rgb(73, 23, 23);
            color: #fff;
            text-align: center;
            padding: 1em 0;
        }

        .hallmark-gold {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 2em;
        }

        .jewelry-item {
            background-color: #fff;

            border-radius: 8px;
            padding: 1em;
            margin: 1em;
            text-align: center;
        }

        .jewelry-item img {
            width: 40%;

            height: auto;
            border-radius: 4px;
        }

        .price {
            color: rgb(73, 23, 23);
            font-weight: bold;
        }

        button {
            background-color: rgb(73, 23, 23);
            color: #fff;
            border: none;
            padding: 0.5em 1em;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn{
            margin-top: 40px;
            margin-left: 10px;
        }

        footer {
            background-color: rgb(73, 23, 23);
            color: #fff;
            text-align: center;
            padding: 1em 0;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
   
        <h1>Hallmark Gold Collection</h1>
    </header>
    <a href="Abhussa.html"><button  class="btn"style=" height: 40px; width: 75px; font-size: medium; padding-right:50px;">HOME</button></a>

    <section class="hallmark-gold">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "jewellerywebsite";


        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }



        $sql = "SELECT id, name, img_dir, weight, price FROM hallmarkgold";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
        ?>
                <article class="jewelry-item">
                    <img src="<?php echo $row["img_dir"]; ?>" alt="<?php echo $row["name"]; ?>">
                    <h2><?php echo $row["name"]; ?></h2>

                    <h2> Weight: <?php echo $row["weight"]; ?> gms</h2>

                    <p class="price">Rs <?php echo $row["price"]; ?></p>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $row["name"]; ?>">
                        <input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
                        <input type="hidden" name="img_dir" value="<?php echo $row["img_dir"]; ?>">
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
                        <button type="submit">Add to Cart</button>
                    </form>
                </article>
        <?php
            }
        } else {
            echo "0 results";
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["img_dir"]) && isset($_POST["quantity"])) {


                $name = $_POST["name"];
                $price = $_POST["price"];
                $img_dir = $_POST["img_dir"];
                $quantity = $_POST["quantity"];
                $customer_id = $_POST["customer_id"];


                $insert_sql = "INSERT INTO carts (name,img_dir, price,  quantity,customer_id) VALUES ('$name',  '$img_dir', '$price','$quantity','$customer_id')";

                if ($conn->query($insert_sql) === TRUE) {
                    echo  "<script>
                    window.alert('Product added successfully');
                    window.location.href = 'addtocart.php';
                </script>";
                    exit;
                } else {
                    echo "<p>Error: " . $insert_sql . "<br>" . $conn->error . "</p>";
                }
            }
        }

        $conn->close();
        ?>
    </section>


    <footer>
        <p>&copy; 1998 Abhushan Jewelry Store</p>
    </footer>

</body>

</html>