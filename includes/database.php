<?php

function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'ipt';

    
    try {
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
$pdo = pdo_connect_mysql();


function template_header($title) {
    
$num_items_in_cart = isset($_SESSION['shopping_cart_tbl']) ? count($_SESSION['shopping_cart_tbl']) : 0;
echo <<<EOT
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>$title</title>
		<link href="public/css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
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
                    <a href="index.php">Home</a>
                    <a href="index.php?page=home/category&category=mobile">Products</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"style="color: white;"></i><span>$num_items_in_cart</span> 
					</a>
                    
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, IPTech</p>
            </div>
        </footer>
    </body>
</html>
EOT;
}
?>