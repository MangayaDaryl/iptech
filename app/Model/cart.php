<?php

session_start();
$is_logged_in = isset($_SESSION['user_id']);

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    
    $product_id = (float)$_POST['product_id'];
    $quantity = (float)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our database
    $stmt = $pdo->prepare('SELECT * FROM products_tbl WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        $total_price = $product['price'] * $quantity;

        $stmt = $pdo->prepare('INSERT INTO shopping_cart_tbl (quantity, total_price) VALUES (?, ?)');
        $stmt->execute([$quantity, $total_price]);
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['shopping_cart_tbl']) && is_array($_SESSION['shopping_cart_tbl'])) {
            if (array_key_exists($product_id, $_SESSION['shopping_cart_tbl'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['shopping_cart_tbl'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['shopping_cart_tbl'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['shopping_cart_tbl'] = array($product_id => $quantity);
        }

    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['shopping_cart_tbl']) && isset($_SESSION['shopping_cart_tbl'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['shopping_cart_tbl'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['shopping_cart_tbl'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['shopping_cart_tbl'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['shopping_cart_tbl'][$id] = $quantity;
                $stmt = $pdo->prepare('SELECT * FROM products_tbl WHERE id = ?');
                $stmt->execute([$id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                // Calculate the new total price
                $total_price = $product['price'] * $quantity;

                // Update the total_price in the shopping_cart table
                $stmt = $pdo->prepare('UPDATE shopping_cart_tbl SET total_price = ? WHERE id = ?');
                $stmt->execute([$total_price, $id]);

                // Update the modified_at column in the shopping_cart table
                $stmt = $pdo->prepare('UPDATE shopping_cart_tbl SET modified_at = CURRENT_TIMESTAMP WHERE id = ?');
                $stmt->execute([$id]);
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['shopping_cart_tbl']) ? $_SESSION['shopping_cart_tbl'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products_tbl WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
    // echo $subtotal;
}

?>
<?php
$num_items_in_cart = isset($_SESSION['shopping_cart_tbl']) ? count($_SESSION['shopping_cart_tbl']) : 0;
?>
<style>
    /* Reset Styles */

{


margin: 0;
padding: 0;
box-sizing: border-box;
}
/* Body Styles */
body {
font-family: "Helvetica Neue", sans-serif;
font-size: 16px;
line-height: 1.5;
color: #333;
}

/* Header Styles */
header {
display: flex;
justify-content: space-between;
align-items: center;
padding: 10px;
background-color: #fff;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Navigation Styles */
nav {
display: flex;
justify-content: center;
align-items: center;
}

nav ul {
display: flex;
list-style: none;
}

nav ul li {
margin-left: 20px;
}

nav ul li a {
text-decoration: none;
color: #333;
transition: color 0.3s ease;
}

nav ul li a:hover {
color: #007aff;
}
    /* Footer Styles */
    footer {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    footer p {
    font-size: 0.8rem;
    }
    #checkout {
        background-color: #15660e;
        width: 100%;
        padding-right:46%;
}
  #checkout:hover {
        background-color: #0d4d0b;
}
.overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #555;
            cursor: pointer;
        }
</style>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Shopping Cart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                    <a href="index.php" style="color: #fff">Home</a>
                    <a href="index.php?page=home/category&category=mobile" style="color: #fff">Products</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart" style="color: white;"></i><span><?=$num_items_in_cart?></span> 
					</a>
                </div>
            </div>
        </header>
<main>
<div class="cart content-wrapper">
    <h1 style="font-size:40px;">Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
        <div class="buttons"><input type="submit" value="Update" name="update"></div>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="public/images/imgs/<?=$product['image_url']?>" width="50" height="50" alt="<?=$product['image_url']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['product_name']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove" style="color:red">Remove</a>
                    </td>
                    <td class="price">&#x20B1;<?=$product['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">&#x20B1;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Total:</span>
            <span class="price">&#x20B1;<?=$subtotal?></span>
        </div>

    </form>
   <!-- Cart Table and Total Calculation -->

   <form action="views/payment.php" method="post">
    <!-- Pass the subtotal from the cart -->
    <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
    <div class="buttons">
        <?php if ($is_logged_in): ?>
            <!-- Enable the button if the user is logged in -->
            <input class="buttons" id="checkout" type="submit" value="Checkout">
        <?php else: ?>
            <!-- Disable the button and display a message if the user is not logged in -->
            <input class="buttons" id="checkout" type="button" value="You need to login first" disabled  style="color: white; background-color: #15660e; cursor: not-allowed;">
        <?php endif; ?>
    </div>
</form>


    </div>
</form>

        </div>
        
    </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; 2024, IPTech</p>
            </div>
        </footer>
    </body>
</html>