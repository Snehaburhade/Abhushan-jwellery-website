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



  $name = mysqli_real_escape_string($conn, $_POST["name"]);
  $reason = mysqli_real_escape_string($conn, $_POST["reason"]);


  $sql = "INSERT INTO preturn(name, reason) VALUES ('$name', '$reason')";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


  header("Location:/JwelleryWebsite/returnmessage.html");
  mysqli_close($conn);
}
