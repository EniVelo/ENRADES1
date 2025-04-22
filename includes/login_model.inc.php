<?php
declare(strict_types=1);
require_once ('dbh.inc.php');

function get_user(PDO $pdo, string $email): array|false {
    $query = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? $user : false;
}
