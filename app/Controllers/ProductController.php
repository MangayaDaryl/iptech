<?php
// The amounts of products to show on each page
$num_products_on_each_page = 2;
// The current page - in the URL, will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM products_tbl ORDER BY created_at DESC LIMIT ?,?');
// bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products_tbl')->rowCount();
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
/* Main Styles */
main {
display: flex;
flex-wrap: wrap;
justify-content: space-between;
padding: 20px;
}

.product {
display: flex;
flex-direction: column;
align-items: center;
text-align: center;
width: calc(25% - 20px);
margin-bottom: 40px;
background-color: #fff;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
border-radius: 10px;
overflow: hidden;
margin-left: 130px;
margin-right:130px;

}

.product img {
width: 100%;
height: auto;
object-fit: cover;

}

.product .name {
    margin-top: 10px;
    font-weight: bold;
    font-size: 1.2rem;
    text-align: center;
}

.product .price {
    margin-top: 5px;
    font-size: 1.5rem;
    font-weight: bold;
    color: #007aff;
    text-align: center;
}

.product:hover {
    transform: translateY(-10px);
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
</style>
<?=template_header('Products')?>

<div class="products content-wrapper">
    
    <h1>Products</h1>
    <p><?=$total_products?> Products</p>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="public/images/<?=$product['image_url']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                 &#8369;<?=$product['price']?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>


<?=template_footer()?>



