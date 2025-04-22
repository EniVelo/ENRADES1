<?php
require_once ('dbh.inc.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "Linku është i pavlefshëm ose ka skaduar.";
        exit();
    }

    $hashed = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?");
    $stmt->execute([$hashed, $user["id"]]);

    echo "Fjalëkalimi u ndryshua me sukses. <a href='login.php'>Kyçu tani</a>";
}
