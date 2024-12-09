<?php
// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ipt', 'root', ''); // Your actual DB credentials
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $product_id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Define the image upload path
    $upload_dir = 'images/imgs/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);  // Create directory if it doesn't exist
    }

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Delete the old image if a new one is uploaded (optional, if you want to remove the old image)
        $stmt = $pdo->prepare("SELECT image_url FROM products_tbl WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product && file_exists($product['image_url'])) {
            unlink($product['image_url']);  // Remove old image
        }

        // Move the new image to the upload directory
        $image_url = $upload_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
    } else {
        // Keep the current image if no new image is uploaded
        $stmt = $pdo->prepare("SELECT image_url FROM products_tbl WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $image_url = $product['image_url']; // Retain the old image URL
    }

    // Update product in the database
    $stmt = $pdo->prepare("UPDATE products_tbl SET product_name = ?, description = ?, price = ?, image_url = ?, category = ? WHERE id = ?");
    $stmt->execute([$product_name, $description, $price, $image_url, $category, $product_id]);

    // Redirect to the admin dashboard
    header('Location: admin_dashboard.php');
    exit();
}
?>
