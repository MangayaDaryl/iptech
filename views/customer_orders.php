<?php
session_start();
include '../includes/database.php';  // Include the database connection

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Redirect to login page if not logged in or not an admin
    header("Location: loginpage.php");
    exit();
}

// Fetch all orders from the database
$stmt = $pdo->prepare("SELECT o.id, o.user_id, o.product_id, p.product_name, o.quantity, o.total_price, o.status, o.order_date, u.email
                        FROM orders_tbl o
                        JOIN products_tbl p ON o.product_id = p.id
                        JOIN users_tbl u ON o.user_id = u.id");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    <style>
        /* Styles for the orders table */
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
    </style>
</head>
<body>
    <header>
        <h1>Customer Orders</h1>
    </header>

    <nav>
        <a href="admin_dashboard.php">Back to Dashboard</a> |
        <a href="logout.php">Logout</a>
    </nav>

    <h2 style="text-align: center;">All Orders</h2>

    <!-- Display orders table -->
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User Email</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                    <td>$<?php echo htmlspecialchars(number_format($order['total_price'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                    <td><?php echo htmlspecialchars(date('F d, Y', strtotime($order['order_date']))); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
