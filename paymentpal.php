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

  print("Connected successfully");



  $Number = mysqli_real_escape_string($conn, $_POST["Number"]);
  $message = mysqli_real_escape_string($conn, $_POST["message"]);
  if (strlen($Number) !== 10) {
    echo '<script>alert("UPI number must be maximum 10 characters long.");</script>';
    mysqli_close($conn);
    exit;
  }





  $sql = "INSERT INTO ppaypal(Number,message) VALUES ('$Number', '$message')";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  header("Location:/JwelleryWebsite/Thankyoupage.php");

  mysqli_close($conn);
}
