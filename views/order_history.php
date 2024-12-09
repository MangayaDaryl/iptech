<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if remove request is made
if (isset($_POST['remove_order_id'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=ipt', 'root', '');
        $stmt = $pdo->prepare("DELETE FROM orders_tbl WHERE product_id = ? AND user_id = ?");
        $stmt->execute([$_POST['remove_order_id'], $user_id]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Fetch orders from the database
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ipt', 'root', '');
    $stmt = $pdo->prepare("
        SELECT 
            o.product_id, 
            p.product_name, 
            p.image_url,  -- Fetch the image URL
            o.quantity, 
            o.total_price, 
            o.status, 
            o.order_date
        FROM orders_tbl o
        JOIN products_tbl p ON o.product_id = p.id
        WHERE o.user_id = ?
    ");
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            color: #333;
        }
        .order-history {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 15px;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:nth-child(odd) {
            background-color: #fff;
        }
        .product-image img {
            max-width: 50px;
            border-radius: 5px;
        }
        .remove-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Order History</h1>
    <div class="order-history">
        <?php if ($orders): ?>
            <table>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="product-image">
                            <img src="/public/images/imgs/<?php echo htmlspecialchars($order['image_url']); ?>" alt="Product Image">
                        </td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($order['total_price'], 2)); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars(date('F d, Y', strtotime($order['order_date']))); ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="remove_order_id" value="<?php echo htmlspecialchars($order['product_id']); ?>">
                                <button type="submit" class="remove-button">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="text-align: center; padding: 20px;">You have no previous orders.</p>
        <?php endif; ?>
    </div>
</body>
</html>
