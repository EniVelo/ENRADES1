<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forget Password</title>
    <style>
        body {
            background-color: #f4c4ed;
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 100px auto;
            width: 400px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #f5b3eb;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .message {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reset Your Password</h2>
    <?php
    if (isset($_SESSION["message"])) {
        echo "<p class='message'>" . $_SESSION["message"] . "</p>";
        unset($_SESSION["message"]);
    }
    if (isset($_SESSION["error"])) {
        echo "<p class='error'>" . $_SESSION["error"] . "</p>";
        unset($_SESSION["error"]);
    }
    ?>
    <form action="../includes/reset_request.inc.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</div>
</body>
</html>
