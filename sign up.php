<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="css/sign up .css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
  <i class="fa-regular fa-gem"></i>
  <h3><a href="LoginAb.html" style="color:rgb(76,23,23)"> Login</a></h3>
  <form id="registrationForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <div class="form">
      <div class="color">
        <div class="lo">
          <h2>Sign up</h2>
        </div>
        <div class="logincss">

          <label for="name">Name:</label><br>
          <input type="text" id="name" name="name" required><br><br>
          <label for="email">Email:</label><br><br>
          <input type="email" id="email" name="email" required><br><br>
          <label for="password">Password:</label><br><br>
          <input type="password" id="password" name="password" required><br><br>
          <label for="cpassword">Confirm Password:</label><br><br>
          <input type="password" id="cpassword" name="cpassword" required><br><br>
          <div class="but">
            <button type="submit">Sign up</button>
          </div>
          <div class="aacount">
            <h5><a href="LoginAb.html" style="color:black"> Already have a accounct?</a></h5>
          </div>
        </div>
      </div>
  </form>
  <?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jewellerywebsite";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);

    if ($password !== $cpassword) {
      echo '<script>alert("Passwords do not match");</script>';
      exit;
    }

    $check_sql = "SELECT * FROM logintable WHERE email = '$email'";
    $result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($result) > 0) {
      echo '<script>alert("Email is already registered");</script>';
      exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO logintable (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {

      $sql_fetch_user = "SELECT id FROM logintable WHERE email = '$email'";
      $result_fetch_user = mysqli_query($conn, $sql_fetch_user);
      if ($result_fetch_user && mysqli_num_rows($result_fetch_user) > 0) {
        $row = mysqli_fetch_assoc($result_fetch_user);
        $user_id = $row['id'];
        $_SESSION['user_id'] = $user_id;
      }


      $_SESSION['user_name'] = $name;
      $_SESSION['user_email'] = $email;

      mysqli_close($conn);
      header("Location: Abhussa.html");
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  ?>