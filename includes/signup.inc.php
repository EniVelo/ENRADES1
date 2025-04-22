<?php
session_start();

$conn = new mysqli("localhost", "root", "", "kozmetike_db");

if ($conn->connect_error) {
    die("Database connection failed!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? ''; 
    $password = $_POST["password"] ?? ''; 
    $fullname = $_POST["name"] ?? ''; 
    $address = $_POST["address"] ?? '';

  
    if (empty($email) || empty($phone) || empty($password) || empty($fullname) || empty($address)) {
        echo "<script>alert('Please fill in all fields!'); window.history.back();</script>";
        exit();
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.history.back();</script>";
        exit();
    }

    if (!preg_match('/^[0-9]{8,15}$/', $phone)) {
        echo "<script>alert('Invalid phone number! Only digits, 8-15 characters allowed.'); window.history.back();</script>";
        exit();
    }

    
    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long!'); window.history.back();</script>";
        exit();
    }

  
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email is already registered!'); window.history.back();</script>";
        $check->close();
        exit();
    }
    $check->close();

    $options = ['cost' => 12];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    
    $role_id = 1;
    
    
    $stmt = $conn->prepare("INSERT INTO users (email, phone, password, name, address, role_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $email, $phone, $hashedPassword, $fullname, $address, $role_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../components/shop.php?signup=success");
        exit();
    } else {
        echo "<script>alert('Error saving data: " . $stmt->error . "'); window.history.back();</script>";
        $stmt->close();
        $conn->close();
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.history.back();</script>";
    exit();
}
?>