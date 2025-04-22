<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location:../login.php"); // Redirect to login page if not admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 40px;
        }
        .dashboard {
            background: #fff;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .admin-links {
            margin-top: 20px;
        }
        .admin-links a {
            display: block;
            margin-bottom: 10px;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        .admin-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h1>Welcome, Admin 👋</h1>
    <p>This is your dashboard. From here you can manage users, products, orders, and more.</p>

    <!-- Display admin details -->
    <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name'] ?? ''); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?></p>
    <p><strong>Role:</strong> Admin</p>

    <div class="admin-links">
        <a href="manage_users.php">👥 Manage Users</a>
        <a href="manage_products.php">🛍️ Manage Products</a>
        <a href="manage_orders.php">📦 Manage Orders</a>
    </div>

    <br>
    <!-- Corrected logout path -->
    <a href="../logout.php">🔒 Logout</a>
</div>

</body>
</html>
