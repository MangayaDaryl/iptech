<?php
// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ipt', 'root', ''); // Your actual DB credentials
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if product ID is set in the URL or form submission
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    // Fetch current product details to populate the form
    $stmt = $pdo->prepare("SELECT * FROM products_tbl WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $product_id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Define the image upload path
    $upload_dir = '/public/images/imgs/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);  // Create directory if it doesn't exist
    }

    // Check if a new image is uploaded
    // Check if a new image is uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Delete the old image if a new one is uploaded (optional)
    $stmt = $pdo->prepare("SELECT image_url FROM products_tbl WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product && file_exists($product['image_url'])) {
        unlink($product['image_url']);  // Remove old image
    }

    // Move the new image to the upload directory
    $upload_dir = 'images/imgs/';  // Assuming the image directory is inside 'public'
    $image_url = $upload_dir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_url)) {
        // Use the relative path for image URL (remove 'public' prefix)
        $image_url = 'images/imgs/' . basename($_FILES['image']['name']);
    }
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 97%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Product</h1>
    </header>

    <form action="edit_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image">

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
