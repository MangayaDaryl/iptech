<?php
session_start();
include '../includes/database.php';  // Include the database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Redirect to login page if not logged in or not an admin
    header("Location: loginpage.php");
    exit();
}

// Fetch all products from the database
$stmt = $pdo->prepare("SELECT * FROM products_tbl");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
        nav {
            margin: 20px;
            text-align: center;
        }
        nav a {
            color: #333;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #ddd;
            border-radius: 5px;
        }
        nav a:hover {
            background-color: #bbb;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: white;
        }
        td img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        td a {
            color: #007BFF;
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }
        .actions a {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <nav>
        <a href="add_product.php">Add Product</a> |
        <a href="logout.php">Logout</a>
        
        
    </nav>

    <h2 style="text-align: center;">All Products</h2>

    <!-- Display products table -->
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                    <td><img src="/public/images/imgs/<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product Image"></td>
                    <td class="actions">
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a> | 
                        <a href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
