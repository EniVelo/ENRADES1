<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = new mysqli("localhost", "root", "", "kozmetike_db");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["password"], $user["password"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: shop.php");
            exit;
        }
    }

    $is_invalid = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ENRADES</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4c4ed;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 30px 20px;
            width: 400px;
            border-radius: 8px;
        }

        .login-title {
            font-style: italic;
            color: #f5b3eb;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #6c757d;
        }

        .form-group input {
            width: 90%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .login-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #f5b3eb;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            border-color: #f5b3eb;
            margin: 15px 0;
        }

        .login-btn:hover {
            background-color: #f1a3e5;
        }

        hr {
            margin: 20px 0;
        }

        .signup-box {
            text-align: center;
        }

        .signup-box p {
            color: #6c757d;
            margin-bottom: 5px;
        }

        .signup-box a {
            color: #f5b3eb;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-box a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            margin: 15px auto;
            width: 90%;
            border-radius: 5px;
            text-align: center;
            font-size: 1rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>


    <div class="container">
        <div class="login-box">
            <h2 class="login-title">ENRADES</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter email" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required />
                </div>

                <div>
                  <a href="forgot_password.php" style="color: grey;">Forgot your password?</a>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <hr />

            <div class="signup-box">
                <p>Don't have an account?</p>
                <a href="signup.php">Signup</a>
            </div>
        </div>
    </div>

</body>
</html>
