<?php
// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ipt', 'root', ''); // Your actual DB credentials
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if product ID is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Get the image URL from the database before deleting the product
    $stmt = $pdo->prepare("SELECT image_url FROM products_tbl WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();

    if ($product) {
        // Delete the image file from the server
        $image_path = $product['image_url'];
        if (file_exists($image_path)) {
            unlink($image_path);  // Deletes the file
        }

        // Delete product from database
        $stmt = $pdo->prepare("DELETE FROM products_tbl WHERE id = ?");
        $stmt->execute([$product_id]);
    }

    // Redirect to admin dashboard after deletion
    header('Location: admin_dashboard.php');
    exit();
}
?>
