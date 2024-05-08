<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jewellerywebsite";


  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }





  $Number = mysqli_real_escape_string($conn, $_POST["Number"]);
  $Date = mysqli_real_escape_string($conn, $_POST["Date"]);
  $cvv = mysqli_real_escape_string($conn, $_POST["cvv"]);
  if (strlen($Number) !== 16) {
    echo '<script>alert("credit card number must be maximum 16 characters long.");</script>';
    mysqli_close($conn);
    exit;
  }
  $Date = mysqli_real_escape_string($conn, $_POST["Date"]);
  if (!ctype_digit($Date)) {
    echo '<script>alert("Expiry date must contain only numbers.");</script>';
    mysqli_close($conn);
    exit;
  }


  $cvv = mysqli_real_escape_string($conn, $_POST["cvv"]);
  if (strlen($cvv) != 3) {
    echo '<script>alert("CVV must be 3 digits long.");</script>';
    mysqli_close($conn);
    exit;
  }



  $sql = "INSERT INTO creditpayment (Number, Date,cvv) VALUES ('$Number', '$Date', '$cvv')";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  header("Location:/JwelleryWebsite/Thankyoupage.php");

  mysqli_close($conn);
}
