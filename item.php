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

if (isset($_POST["add"])) {
    $productId = $_GET["id"];
    $productName = $_POST["name"];
    $productdescription = $_POST["description"];
    $productImage = $_POST["hidden_image"];
    $productPrice = $_POST["hidden_price"];
    $productQuantity = $_POST["quantity"];
    $customer_id =  $_SESSION['user_id'];

    $sql = "INSERT INTO carts( description, name, img_dir, price, quantity,customer_id) VALUES ( '$productdescription', ' $productName', '$productImage','   $productPrice','$productQuantity','$customer_id');";
    mysqli_query($conn, $sql);
}


?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <style>
        .product {

            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 40px;
            margin-bottom: 30px;
            background-color: rgb(202, 202, 202);
            width: calc(25% - 40px);
        }

        .product img {
            width: 100%;
            height: auto;
            border-top-left-radius: 5px;
            border-top-right-radius: 8px;
            padding-top: 25px;
        }

        .product .product-body {
            padding: 1rem;
            margin-left: 60px;
        }

        .product.product-name {
            color: rgb(76, 23, 23) !important;
            font-weight: bold !important;
            font-size: 0% !important;
            margin-bottom: 0.02rem !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
            padding-top: 15px;
        }

        .product .form-control {
            width: calc(100% - 20px);
            margin: 0 auto 0.5rem auto;
            font-size: 0.2rem;
        }

        .product .btn-primary {
            color: rgb(76, 23, 23);
            border-color: rgb(76, 23, 23);
            width: 100%;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .product .btn-primary:hover {
            background-color: #5c1717;
            border-color: #5c1717;
        }

        .btn-marron {
            background-color: rgb(76, 23, 23);
        }

        .bg-marron {
            background-color: rgb(76, 23, 23);

        }

        .review-section {
            margin-top: 10px;
        }

        .review-section .star-rating {
            display: inline-block;
        }

        .review-section .star-rating input[type="radio"] {
            display: none;
        }

        .review-section .star-rating label {
            font-size: 30px;
            color: gray;
            cursor: pointer;
        }

        .review-section .star-rating label:before {
            content: '\2605';
        }

        .review-section .star-rating input[type="radio"]:checked~label {
            color: rgb(76, 23, 23);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-marron">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto text-light" href="#">Abhushan Jewelry World</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="Abhussa.html">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="Aboutus.html">About us</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="Contact.html">Contact us</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="../JwelleryWebsite/categorys.php">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?catergory=necklace">Necklace</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?catergory=earring">Earrings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?catergory=ring">Ring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?catergory=bracelets">Bracelets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?catergory=chain">Chains</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?catergory=Mangalsutra">Mangalsutra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?catergory=anklet">Anklet</a>
                </li>

            </ul>
        </div>
    </nav>
    <main>
        <div class="container ">
            <div class="row">
                <?php
                include('connect.php');
                $catergory = "";


                if (isset($_GET['catergory'])) {
                    $catergory = $_GET['catergory'];
                    switch ($catergory) {
                        case "necklace":
                            $table_name = 'pnecklace';
                            break;
                        case "bracelets":
                            $table_name = 'pbracelets';
                            break;
                        case "ring":
                            $table_name = 'pring';
                            break;
                        case "chain":
                            $table_name = 'pchains';
                            break;
                        case "earring":
                            $table_name = 'pearrings';
                            break;
                        case "Mangalsutra":
                            $table_name = 'pMangalsutra';
                            break;

                        case "anklet":
                            $table_name = 'panklet';
                            break;

                        default:
                            die("Invalid category specified");
                    }
                    $select_query = "SELECT * FROM $table_name ORDER BY id ASC";
                    $result = mysqli_query($conn, $select_query);
                } else {
                    echo "<script>
              window.alert('Product added successfully');
              window.location.href = 'addtocart.php';
          
          </script>";
                    exit;
                }
                $result_query = mysqli_query($con, $select_query);


                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];


                ?>

                        <div class="product">

                            <form action="item.php?action=add&id=<?php echo $row["id"] ?>" method="post">
                                <div class="products">
                                    <img src="<?php echo $row["img_dir"]; ?>" alt="">
                                    <h3><?php echo $row["name"] ?></h3>
                                    <h3><?php echo $row["description"] ?></h3>
                                    <p>Rs:<?php echo $row["price"]; ?></p>
                                    <p>Weight:<?php echo $row["weight"]; ?>gms</p>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">

                                    <input type="hidden" name="hidden_image" value="<?php echo $row["img_dir"]; ?>">
                                    <input type="hidden" name="name" value="<?php echo $row["name"]; ?>">
                                    <h6><input type="hidden" name="description" value="<?php echo $row["description"]; ?>"></h6>
                                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                    <input type="submit" name="add" value="Add to Cart">
                                    <?php echo " <a href='bilingpage.php?catergory=$catergory&id=$id' class='btn btn-marron text-light'>Buy now</a>" ?>



                                    <div class="review-section">
                                        <p>Rate this product:</p>
                                        <div class="star-rating">
                                            <input type="radio" id="star5_<?php echo $id; ?>" name="rating_<?php echo $id; ?>" value="5"><label for="star5_<?php echo $id; ?>"></label>
                                            <input type="radio" id="star4_<?php echo $id; ?>" name="rating_<?php echo $id; ?>" value="4"><label for="star4_<?php echo $id; ?>"></label>
                                            <input type="radio" id="star3_<?php echo $id; ?>" name="rating_<?php echo $id; ?>" value="3"><label for="star3_<?php echo $id; ?>"></label>
                                            <input type="radio" id="star2_<?php echo $id; ?>" name="rating_<?php echo $id; ?>" value="2"><label for="star2_<?php echo $id; ?>"></label>
                                            <input type="radio" id="star1_<?php echo $id; ?>" name="rating_<?php echo $id; ?>" value="1"><label for="star1_<?php echo $id; ?>"></label>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                <?php
                    }
                }
                ?>
            </div>




    </main>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-F2f/u4ExOJ4pTkgTtqH8oDVSaUprBybGaL+a+MxRJ6ly/c8rSDOeEQXgq6XqI+N/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>