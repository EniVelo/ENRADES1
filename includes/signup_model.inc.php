<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

function get_email(PDO $pdo, string $email): array|false {
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_user($pdo, $email) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

function set_user(PDO $pdo, string $email, string $phone, string $password, string $fullname, string $address): void {
    $query = "INSERT INTO users (email, phone, password, name, address) 
              VALUES (:email, :phone, :password, :name, :address);";
    $stmt = $pdo->prepare($query);

    $options = ['cost' => 12];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":name", $fullname);
    $stmt->bindParam(":address", $address);
    $stmt->execute();
}
?>
