<?php
session_start();


if (isset($_SESSION['user_id']) || isset($_SESSION['user_name']) || isset($_SESSION['user_email'])) {

    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
}


header('location: sign up.php');
exit;
