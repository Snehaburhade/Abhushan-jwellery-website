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

    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $sql = "SELECT id, name, email, password FROM logintable WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];


        if (password_verify($password, $stored_password)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            header("Location:/JwelleryWebsite/Abhussa.html");
        } else {
            echo '<script>alert("Incorrect password");</script>';

            exit;
        }
    } else {

        echo '<script>alert("User not found");</script>';

        exit;
    }

    mysqli_close($conn);
}
