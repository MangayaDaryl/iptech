<?php
session_start();

// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products_tbl');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_items_in_cart = isset($_SESSION['shopping_cart_tbl']) ? count($_SESSION['shopping_cart_tbl']) : 0;
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link href="public/css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="content-wrapper">
        <h1>
            <a href="index.php">
                <img src="public/images/logo.png" alt="IPTech Logo" style="height: 50px;"/>
            </a>
        </h1>
        <nav>
            <a href="index.php" style="text-decoration: none; color: #fff;">Home</a>
            <a href="index.php?page=home/category" style="text-decoration: none; color: #fff;">Products</a>
          
        </nav>

        <div class="link-icons">
            <a href="index.php?page=cart">
                <i class="fas fa-shopping-cart" style="color: white;"></i><span><?=$num_items_in_cart?></span>
            </a>
        </div>

        


        <div class="auth-links">
    <?php if (isset($_SESSION['user_email'])): ?>
        <!-- User is logged in, show profile and logout options -->
        <div class="profile">
            <a href="/views/profile.php" style="text-decoration: none; color: inherit;">
                <i class="fas fa-user-circle" style="color: white; font-size: 2rem;"></i>
            </a>
</div>
<a href="views/order_history.php" style="text-decoration: none; color: white; margin-left: 15px;">Order History</a>   
                <a href="views/logout.php" style="text-decoration: none; color: white; margin-left: 15px;">Logout</a>

            <?php else: ?>
                <!-- User is not logged in, show login and sign up options -->
                <a href="/views/loginpage.php" style="text-decoration: none; color: white; margin-left: 15px;">Login</a>
                <span style="color: white; margin: 0 10px;">|</span>
                <a href="/views/signup.php" style="text-decoration: none; color: white; margin-left: 10px;">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>
</header>

</body>
</html>
