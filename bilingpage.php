<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biling Form</title>
    <link rel="stylesheet" href="css/biling.css">
</head>

<body>


    <div class="product-container">
        <div class="product-info">

            <?php
            include('connect.php');
            $catergory = "";
            $table_name = "";
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
                    case "nath":
                        $table_name = 'pnath';
                        break;
                    case "anklet":
                        $table_name = 'panklet';
                        break;

                    default:
                        die("Invalid category specified");
                }
            } else {

                die("No category specified");
            }


            "No data found for the given ID.";





            session_start();
            if (isset($_SESSION['user_id'])) {
                $customer_id = $_SESSION['user_id'];
            } else {

                header("Location: login.php");
                exit;
            }

            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM $table_name WHERE id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {

                    $row = $result->fetch_assoc();
                    $name = $row['name'];
                    $img_dir = $row['img_dir'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $weight = $row['weight'];
                    echo "<h2>" . $row['name'] . "</h2>";
                    echo "<img src='" . $row['img_dir'] . "' alt='' class='product-image'>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<p>Price:  " . $row['price'] . "</p>";
                    echo "<p> Weight: " . $row['weight'] . "gms</p>";


                    $insert_sql = "INSERT INTO orders (product_name, product_image, description, product_price, weight,customer_id) VALUES (?, ?, ?, ?, ?,?)";
                    $insert_stmt = $con->prepare($insert_sql);

                    $insert_stmt->bind_param("sssisi", $name, $img_dir, $description, $price, $weight, $customer_id);

                    if ($insert_stmt->execute()) {
                    } else {
                        echo "Error adding product to orders: " . $insert_stmt->error;
                    }
                } else {
                    echo "No data found for the given ID.";
                }

                $stmt->close();
                $con->close();
            } else {
                echo "Invalid ID provided.";
            }
            ?>




        </div>

        <div class="returnpolicy">

            <a href="returnpolicy.html">
                <button>Return policy</button></a>
        </div>
        <form action="" method="post">
            <div class="billing-section">
                <h3>Billing Address</h3>
                <label for="username11">Enter Name:</label>
                <input type="text" placeholder="Enter Name" id="username11" name="names" required>

                <label for="username12">Enter Email:</label>
                <input type="email" placeholder="Enter Email" id="username12" name="emails" required>

                <label for="username13">Enter Address:</label>
                <input type="text" placeholder="Enter Address" id="username13" name="addresss" required>

                <label for="username14">Enter Number:</label>
                <input type="text" placeholder="Enter Number (10 digits)" id="username14" name="numbers" minlength="10" maxlength="10" pattern="\d*" required>

                <label for="username15">Enter City:</label>
                <input type="text" placeholder="Enter City" id="username15" name="citys" required>

                <label for="state">State:
                    <select id="state" name="states">
                        <option>Choose State...</option>

                        <option>Maharashtra</option>
                        <option>Rajasthan</option>
                        <option>Haryana</option>
                        <option>Uttar Pradesh</option>
                    </select>
                </label>

                <label for="username16">Zipcode:</label>
                <input type="text" placeholder="Zip Code (6 digits)" id="username16" name="zipcodes" pattern="[0-9]{6}" required>
                <button class="purchase-btn">Payment</button>
                <h5>Payment mode </h5>
            </div>

        </form>


        <?php

        include('connect.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "jewellerywebsite";


            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            print("Connected successfully");

            $name = mysqli_real_escape_string($conn, $_POST["names"]);
            $email = mysqli_real_escape_string($conn, $_POST["emails"]);
            $address = mysqli_real_escape_string($conn, $_POST["addresss"]);
            $number = mysqli_real_escape_string($conn, $_POST["numbers"]);
            $city = mysqli_real_escape_string($conn, $_POST["citys"]);
            $state = mysqli_real_escape_string($conn, $_POST["states"]);
            $zipcode = mysqli_real_escape_string($conn, $_POST["zipcodes"]);



            $sql = "INSERT INTO billpage (names, emails, addresss,numbers,citys,states,zipcodes) VALUES ('$name', '$email', '$address','$number','$city','$state','$zipcode')";


            if (mysqli_query($conn, $sql)) {

                header("Location: payments.html");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
        ?>
</body>

</html>