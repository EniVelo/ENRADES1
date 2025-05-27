<?php 
session_start();



$mysqli = new mysqli("localhost", "root", "", "sara_db");
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$all_products = [];
$result = $mysqli->query("SELECT id, name, price FROM products");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $all_products[$row['id']] = [
            'name' => $row['name'],
            'price' => $row['price']
        ];
    }
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: kreu.html");
    exit;
}

$is_admin = isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2;
$is_client = isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1;

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ENRADES Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fff9fc;
    }

    .navbar-brand {
      font-size: 28px;
      font-weight: bold;
      color: #e883d3;
    }

    .nav-link {
      color: #555;
      font-weight: 500;
    }

    .nav-link.active,
    .nav-link:hover {
      color: #e883d3;
    }

    .product-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s ease;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .product-card img {
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
      height: 300px;
      object-fit: cover;
      width: 100%;
    }

    .product-card h5 {
      color: #e883d3;
      margin-top: 10px;
      font-weight: bold;
    }

    .logout-btn {
      background-color: #e883d3;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 5px;
      font-weight: 500;
      cursor: pointer;
    }

    .logout-btn:hover {
      background-color: #d46dbf;
    }

    footer {
      background: #f8f9fa;
      padding: 40px 0;
      margin-top: 60px;
      text-align: center;
    }

    /* Shtojmë stilin për shportën (cart) */
    #cart-summary {
      cursor: pointer;
      background: #e883d3;
      padding: 10px;
      border-radius: 5px;
      color: white;
      font-weight: 600;
      display: inline-block;
    }

    #cart-details {
      display: none;
      background: #f9f9f9;
      border: 1px solid #ccc;
      padding: 10px;
      width: 320px;
      position: absolute;
      right: 10px;
      top: 60px;
      z-index: 999;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .admin-controls {
      margin: 20px;
      text-align: center;
    }

    .admin-controls a {
      background-color: #e883d3;
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      margin: 5px;
      display: inline-block;
    }

    .admin-controls a:hover {
      background-color: #d46dbf;
    }

    .products-wrapper {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      padding: 30px;
    }

    .product {
      text-align: center;
      width: 250px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      padding-bottom: 20px;
    }

    .product img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }

    .product p {
      margin-top: 10px;
      font-weight: bold;
      color: #e883d3;
    }
  </style>
</head>

<body>

 <!DOCTYPE html>
<html lang="en">
<head>
    <title>ENRADES</title>
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
            flex-direction: column;
            align-items: flex-end;
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

        .admin-controls {
            margin: 20px;
            text-align: center;
        }

        .admin-controls a {
            background-color: pink;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
        }

        .admin-controls a:hover {
            background-color: #ff99cc;
        }

        .products-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 30px;
        }

        .product {
            text-align: center;
            width: 250px;
        }

        .product img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product p {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
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
                <a href="./kontakti.php">Na Kontaktoni</a>
            </div>

            <div class="search-logout-wrapper">
                <div class="search-bar">
                    <span>Search:</span>
                    <input type="text" class="search-input" placeholder="Type here...">
                </div>

               <?php if ($is_client): ?>
    <div style="position: relative;">
        <?php
        // --- NEW ---
        $cart        = $_SESSION['cart'] ?? [];   // 1)
        $total_items = array_sum($cart);          // 2)
        ?>

        <div id="cart-summary"
             onclick="toggleCartDetails()"
             style="cursor: pointer; background: pink; padding: 10px; border-radius: 5px;">
            Shporta (<?= $total_items ?>)
        </div>

        <div id="cart-details"
             style="display:none; background:#f9f9f9; border:1px solid #ccc;
                    padding:10px; width:300px; position:absolute; right:0; top:40px; z-index:999;">
            <?php
            $total = 0;
            if ($cart) {                         // tani përdor $cart
                foreach ($cart as $id => $qty) {
                    if (isset($all_products[$id])) {
                        $item     = $all_products[$id];
                        $subtotal = $item['price'] * $qty;
                        $total   += $subtotal;

                        echo "<p><strong>{$item['name']}</strong> - {$qty} x {$item['price']}€ 
                              <a href='update_cart.php?action=decrease&id=$id' style='color:orange;'>&minus;</a> 
                              <a href='update_cart.php?action=increase&id=$id' style='color:green;'>&plus;</a> 
                              <a href='update_cart.php?action=remove&id=$id' style='color:red;'>(Hiq)</a></p>";
                    }
                }
                echo "<div style='margin-top:30px;font-weight:bold;'>Totali: {$total}€</div>";
                echo "<div style='margin-top:50px;'>Cash on Delivery (COD)</div>";
                echo "<div style='margin-top:20px;'>Transporti 0 €</div>";
                echo '<div style="margin-top:40px;">
                          <form action="../include/checkout.php" method="post">
                              <button type="submit" class="logout-btn">Përfundo Blerjen</button>
                          </form>
                      </div>';
            } else {
                echo "<p>Shporta është bosh.</p>";
            }
            ?>
        </div>
    </div>
<?php endif; ?>

                              <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2): ?>
    <a href="../include/orders_admin.php" class="logout-btn">Menaxho Porositë</a>
<?php elseif ($_SESSION['role_id'] == 1): ?>
    <a href="../include/my_orders.php" class="logout-btn">Porositë e mia</a>
<?php endif; ?>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST">
                        <button type="submit" name="logout" class="logout-btn">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="login.php" class="logout-btn" style="text-decoration: none;">Login</a>
                <?php endif; ?>





            </div>
        </div>
    </header>

    <div class="products-wrapper">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "sara_db");

        if ($mysqli->connect_error) {
            die("Database connection failed: " . $mysqli->connect_error);
        }

        $result = $mysqli->query("SELECT * FROM products");

        while ($row = $result->fetch_assoc()):
        ?>
        <div class="product">
            <a href="../include/product.php?id=<?php echo $row['id']; ?>" style="color: #000;">
                <img src="../img/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
            </a>

            <p><?php echo htmlspecialchars($row['name']); ?></p>

            <?php if ($is_client): ?>
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                <button type="submit" class="logout-btn" style="margin-top: 5px;">Shto në shportë</button>
            </form>
            <?php endif; ?>

            <?php if ($is_admin): ?>
                <div class="admin-controls">
                    <a href="../include/edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="../include/delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            <?php endif; ?>
            <hr>
        </div>
        <?php endwhile; ?>
    </div>

    <?php if ($is_admin): ?>
    <div class="admin-controls">
        <a href="../include/add_product.php">Add New Product</a>
    </div>
    <?php endif; ?>

    <div class="footer"></div>

    <script>
    function toggleCartDetails() {
        const details = document.getElementById('cart-details');
        details.style.display = (details.style.display === 'none' || details.style.display === '') ? 'block' : 'none';
    }
    </script>
</body>
</html>