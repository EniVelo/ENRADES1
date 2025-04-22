<?php
session_start();
require_once('dbh.inc.php');
require_once('login_model.inc.php');
require_once('login_contr.inc.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $pwd = $_POST["password"] ?? '';


    if (is_input_empty($email, $pwd)) {
        $_SESSION["errors_login"][] = "Please fill in all fields!";
        header("Location: ../components/login.php");
        exit();
    }


    $user = get_user($pdo, $email);

   
    if (!$user || !password_verify($pwd, $user["password"])) {
        $_SESSION["errors_login"][] = "Invalid email or password!";
        header("Location: ../components/login.php");
        exit();
    }


    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_email"] = $user["email"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["role"] = $user["role_id"];

   
    if ($user["role_id"] == 2) {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../components/shop.php?login=success");
    }

    exit();
}
?>
