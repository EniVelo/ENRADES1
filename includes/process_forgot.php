<?php
require_once 'dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $pdo->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE email=?");
        $stmt->execute([$token, $expiry, $email]);

        $resetLink = "http://localhost/ENRADES/reset_password.php?token=$token";

        // Simulo dërgimin e emailit
        echo "Linku për rikuperim është: <a href='$resetLink'>$resetLink</a>";
    } else {
        echo "Ky email nuk ekziston në sistem.";
    }
}
