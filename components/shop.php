<?php 
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: kreu.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENRADES</title>

    <!-- Fonti Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        header {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header-text {
            text-align: center;
            height: 30px;
            font-size: 13px;
        }

        .hr {
            margin-top: 12px;
            border: 1px solid pink;
            width: 100%;
        }

        .header-a {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 90%;
        }

        .header-a a {
            text-decoration: none;
            color: black;
            margin-left: 20px;
        }

        .header-a .active {
            border-bottom: 2px solid #000;
        }

        .logo a {
            color: pink;
            margin-right: 100px;
            text-decoration: none;
        }

        .search-logout-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 5px;
        }

        .logout-btn {
            padding: 5px 10px;
            background-color: pink;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .logout-btn:hover {
            background-color: #ff99cc;
        }

        .footer {
            height: 150px;
        }

        .hg {
            box-sizing: border-box;
            display: inline-block;
            width: 33%;
            text-align: center;
            padding: 0 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-text">
            <p>Hey Bukuroshe, Mire se erdhe ne ENRADES</p>
        </div>
        <div class="hr"></div>
        <div class="header-a">
            <div style="display: flex; align-items: center;">
                <div class="logo">
                    <a href="./Kreu.html">
                        <h1>ENRADES</h1>
                    </a>
                </div>
                <a href="./Kreu.html">Kreu</a>
                <a href="./about.html">Kush jemi</a>
                <a href="./shop.php" class="active">Shop</a>
                <a href="./kontakti.html">Na Kontaktoni</a>
            </div>

            <div class="search-logout-wrapper">
                <div class="search-bar">
                    <span>Search:</span>
                    <input type="text" class="search-input" placeholder="Type here...">
                </div>

                <!-- Butoni Logout/Login -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST">
                        <button type="submit" name="logout" class="logout-btn">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="login.php" class="logout-btn" style="text-decoration: none; display: inline-block;">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div class="hg">
        <a href="./blush.html" style="color: #000;">
            <img src="../img/blush.jpg" style="height:300px;" alt="Kuqalashe Blush Duo">
            <p>Blush</p>
        </a>
        <hr>
    </div>

    <div class="hg">
        <a href="./bronzer.html" style="color: #000;">
            <img src="../img/bronzer.jpg" style="height:300px;" alt="Bronzer">
            <p>Bronzer</p>
        </a>
        <hr>
    </div>

    <div class="hg">
        <a href="./highlighter.html" style="color: #000;">
            <img src="../img/highlighter.jpg" style="height:300px;" alt="Highlighter">
            <p>Highlighter</p>
        </a>
        <hr>
    </div>

    <div class="footer"></div>

</body>
</html>
