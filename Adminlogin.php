<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <form method="POST" action="">

        <div class="form">
            <div class="color">
                <div class="lo">
                    <h2>Admin Login</h2>
                </div>
                <div class="logincss">
                    <label> Email:- </label><br /><br />
                    <input type="email" placeholder="email" name="loginEmail" id="e"><br /><br />
                    <span id="ail"></span>

                    <label>Password:- </label><br /><br />
                    <input type="password" placeholder="password" name="loginPassword" id="p"><br /><br />
                    <span id="word"></span>
                    <div class="but">
                        <button type="submit">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jewellerywebsite";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT id FROM adminlogin WHERE loginEmail = ? AND loginPassword = ?";
    $stmt = $conn->prepare($sql);


    $stmt->bind_param("ss", $email, $password);


    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    $stmt->execute();


    $stmt->bind_result($admin_id);


    if ($stmt->fetch()) {

        header("Location: /JwelleryWebsite/Admin.php");
        exit;
    } else {

        echo '<script>alert("Invalid email or password. Please try again.");</script>';
    }


    $stmt->close();
    $conn->close();
}
?>