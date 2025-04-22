<?php
session_start();

if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['reset_token']) {
    echo "Invalid or expired token.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Password</title>
</head>
<body>
    <form action="../includes/reset_password.inc.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <label>New Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
