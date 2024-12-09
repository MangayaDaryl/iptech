<?php

    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'ipt';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Get the category_id from the URL
$category_id = $_GET['category_id'] ?? null;

if (!$category_id) {
    die('Category not specified.');
}

// Fetch products for the selected category
$stmt = $pdo->prepare('SELECT * FROM products_tbl WHERE category_id = ? AND stock > 0');
$stmt->execute([$category_id]);
$products = $stmt->fetchAll();

// Fetch category name
$categoryStmt = $pdo->prepare('SELECT name FROM categories_tbl WHERE id = ?');
$categoryStmt->execute([$category_id]);
$category = $categoryStmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($category['product_name']) ?> Products</title>
</head>
<body>
    <h1><?= htmlspecialchars($category['product_name']) ?> Products</h1>
    <?php if (count($products) > 0): ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <a href="product.php?id=<?= htmlspecialchars($product['id']) ?>">
                        <h2><?= htmlspecialchars($product['product_name']) ?></h2>
                        <img src="public/images/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" width="150">
                        <p>Price: ₱<?= htmlspecialchars($product['price']) ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No products available in this category.</p>
    <?php endif; ?>
</body>
</html>