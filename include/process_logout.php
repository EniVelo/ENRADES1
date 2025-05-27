<?php

session_start();


if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy();
    header("Location: Kreu.html");
    exit();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>