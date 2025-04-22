<?php
require_once ('dbh.inc.php');

$token = $_GET["token"] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND token_expiry > NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user) {
    echo "Linku është i pavlefshëm ose ka skaduar.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Vendos fjalëkalim të ri</h2>
    <form action="../includes/reset_password.inc.php" method="post">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <label>Fjalëkalimi i ri:</label>
        <input type="password" name="password" required>
        <button type="submit">Ndrysho fjalëkalimin</button>
    </form>
</body>
</html>
