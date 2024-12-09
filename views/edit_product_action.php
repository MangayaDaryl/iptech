<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $image_url = $_FILES['image']['name'] ? "/public/images/imgs/" . $_FILES['image']['name'] : $_POST['current_image'];

    if ($_FILES['image']['name']) {
        move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
    }

    // Update product in database
    $stmt = $pdo->prepare("UPDATE products_tbl SET product_name = ?, price = ?, image_url = ? WHERE id = ?");
    $stmt->execute([$product_name, $price, $image_url, $product_id]);

    header('Location: admin_dashboard.php');
    exit();
}
?>