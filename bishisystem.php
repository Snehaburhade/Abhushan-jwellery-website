<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Chit Fund Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: rgb(76, 23, 23);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4CAF50;
        }

        .month-container {
            margin-top: 20px;
        }

        .month {
            padding: 20px;
            width: 100%;
            background: rgb(76, 23, 23);
            text-align: center;
            margin: 20px auto;
            color: white;
            border-radius: 5px;
        }

        .month .prev,
        .month .next {
            cursor: pointer;
            user-select: none;
            color: white;
        }

        .month .prev:hover,
        .month .next:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .month .days {
            padding: 10px 0;
            background: #f2f2f2;
            text-align: center;
            margin: 0 auto;
            border-radius: 5px;
        }

        .month .days .day {
            display: inline-block;
            width: 13.6%;
            line-height: 2em;
            margin: 1.5%;
            text-align: center;
            cursor: pointer;
            color: rgb(76, 23, 23);
        }

        .month .days .day.other {
            color: #777;
        }

        .month .days .day.today {
            background: #ddd;
        }

        .invest-panel {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .invest-panel h3 {
            margin-top: 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Jewelry Chit Fund Scheme</h2>
        <form action="" method="post">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>

            <button type="button" onclick="showCalendar()">Invest Now</button>
            <input type="hidden" id="selectedMonth" name="month">
            <input type="hidden" id="selectedDate" name="date">
        </form>

        <div class="month-container">
            <div class="month" id="calendar" style="display:none;">
                <div class="prev" onclick="prevMonth()">&#10094;</div>
                <div class="next" onclick="nextMonth()">&#10095;</div>
                <div class="days">
                    <?php

                    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");


                    $currentMonth = date("n");
                    $currentYear = date("Y");


                    if ($currentMonth == 4 && $currentYear == 2024) {
                        echo '<div class="month-name" style="color: rgb(76,23,23);">' . $months[$currentMonth - 1] . ' ' . $currentYear . '</div>';
                    } else {
                        echo '<div class="month-name">' . $months[$currentMonth - 1] . ' ' . $currentYear . '</div>';
                    }
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

                    for ($i = 1; $i <= $daysInMonth; $i++) {
                        echo "<div class='day' onclick='setSelectedDate}($i)'>$i</div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="invest-panel" id="invest-panel" style="display:none;">
            <h3>Investment Details</h3>
            <p id="investment-details"></p>
        </div>
    </div>

    <script>
        function showCalendar() {
            document.getElementById('calendar').style.display = 'block';
        }

        function setSelectedDate(date) {
            var month = document.getElementById('selectedMonth').value;
            document.getElementById('selectedDate').value = date;
            document.getElementById('invest-panel').style.display = 'block';
            document.getElementById('investment-details').innerHTML = "Investment for " + month + " " + date + ", 2024";
        }

        function prevMonth() {

        }

        function nextMonth() {

        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $month = $_POST['month'];
        $date = $_POST['date'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "jewellerywebsite";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO bishisystem (name, email, phone, month, date)
    VALUES ('$name', '$email', '$phone', '$month', '$date')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>