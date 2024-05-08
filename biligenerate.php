<?php
include('connect.php');
session_start();
if (isset($_SESSION['user_id'])) {
    $customer_id = $_SESSION['user_id'];
} else {

    header("Location: login.php");
    exit;
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM billpage WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invoice</title>
            <style>

            </style>
        </head>

        <body>
            <h2>Invoice</h2>
            <p>Name: <?php echo $row['names']; ?></p>
            <p>Email: <?php echo $row['emails']; ?></p>
            <p>Address: <?php echo $row['addresss']; ?></p>
            <p>Number: <?php echo $row['numbers']; ?></p>
            <p>City: <?php echo $row['citys']; ?></p>
            <p>State: <?php echo $row['states']; ?></p>
            <p>Zipcode: <?php echo $row['zipcodes']; ?></p>


            <h2>Form Input Details</h2>
            <p>Name: <?php echo $_POST['names']; ?></p>
            <p>Email: <?php echo $_POST['emails']; ?></p>
            <p>Address: <?php echo $_POST['addresss']; ?></p>
            <p>Number: <?php echo $_POST['numbers']; ?></p>
            <p>City: <?php echo $_POST['citys']; ?></p>
            <p>State: <?php echo $_POST['states']; ?></p>
            <p>Zipcode: <?php echo $_POST['zipcodes']; ?></p>
        </body>

        </html>
<?php
    } else {
        echo "No data found for the given ID.";
    }

    $stmt->close();
} else {
    echo "Invalid ID provided.";
}

$con->close();
?>