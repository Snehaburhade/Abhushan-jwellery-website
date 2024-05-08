<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
    echo '<script>';
    echo 'alert("ID: ' . $_SESSION['user_id'] . '\nName: ' . $_SESSION['user_name'] . '\nEmail: ' . $_SESSION['user_email'] . '");';
    echo '  window.location.href = "Abhussa.html"';
    echo '</script>';
} else {

    header("Location: login.php");
    exit;
}
