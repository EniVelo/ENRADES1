<?php
require_once('../includes/config_session.inc.php');
require_once('../includes/login_view.inc.php');
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
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2 class="login-title">ENRADES</h2>
            <form action="../includes/login.inc.php" method="POST">
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

    <?php 
    check_login_errors(); // Make sure this function is defined in your login_view.inc.php
     ?>
</body>
</html>
