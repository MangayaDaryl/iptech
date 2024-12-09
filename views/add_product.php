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
    // Get the form inputs
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Define the image upload path
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/images/imgs/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);  // Create the directory if it doesn't exist
    }

    // Get the image URL (path to the image)
    $image_url = '/public/images/imgs/' . basename($_FILES['image']['name']); // Relative path

    // Check if the file is uploaded correctly
    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . basename($_FILES['image']['name']))) {
        // Insert the product into the database
        $stmt = $pdo->prepare("INSERT INTO products_tbl (product_name, description, price, image_url, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product_name, $description, $price, $image_url, $category]);

        // Redirect to the admin dashboard after insertion
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
        input, select, textarea {
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
        <h1>Add New Product</h1>
    </header>

    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="description">Product Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="mobile">Cellphone</option>
            <option value="television">TV</option>
            <option value="aircondition">Aircondition</option>
            <option value="homeappliances">Home Appliances</option>
            <!-- Add more categories here -->
        </select>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" required>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
