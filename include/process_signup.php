<?php

if (
    empty($_POST["email"]) ||
    empty($_POST["phone"]) ||
    empty($_POST["name"]) ||
    empty($_POST["password"]) ||
    empty($_POST["address"])
) {
    echo "<script>alert('Please fill in all the blank spaces'); window.history.back();</script>";
    exit;
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Valid email is required'); window.history.back();</script>";
    exit;
}

if (strlen($_POST["password"]) < 8 ||
    !preg_match("/[a-z]/i", $_POST["password"]) ||
    !preg_match("/[0-9]/i", $_POST["password"])) {
    echo "<script>alert('Password must be at least 8 characters and contain letters and numbers'); window.history.back();</script>";
    exit;
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (email, phone, password, name, address)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
    $_POST["email"],
    $_POST["phone"],
    $password_hash,
    $_POST["name"],
    $_POST["address"]
);

if ($stmt->execute()) {
    echo "<script>alert('Signup successful!'); window.location.href='../components/shop.php';</script>";
} else {
    if($mysqli->errno === 1062) {
        echo "<script>alert('Email already taken!'); window.location.href='../components/signup.php';</script>";
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
?>
