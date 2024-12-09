<?php

include 'views/home/header.php';
// Define an array of specific product IDs
$specific_product_ids = [10, 13, 28, 30, 35, 42];  // Replace with the IDs of the products you want to show

// Prepare the SQL query to fetch the specific products
$placeholders = implode(',', array_fill(0, count($specific_product_ids), '?'));
$stmt = $pdo->prepare("SELECT * FROM products_tbl WHERE id IN ($placeholders)");
$stmt->execute($specific_product_ids);
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If no products were found, set $recently_added_products to an empty array
if (!$recently_added_products) {
    $recently_added_products = [];
}



$num_items_in_cart = isset($_SESSION['shopping_cart_tbl']) ? count($_SESSION['shopping_cart_tbl']) : 0;
?>
<style>
        /* Reset Styles */
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    /* Body Styles */
    body {
    font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
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

    .main {
    background-color: #f2f2f2;
    }

    .featured {
    display: flex;
    flex-direction: column;
    background-repeat: no-repeat;
    background-size: cover;
    height: 500px;
    align-items: center;
    justify-content: center;
    text-align: center;
    }
    .products {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

    .product-wrapper {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-wrap: wrap;
    padding: 50px;
    }

    .product {
    margin-right: 9px;
    background-color: #fff;
    
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
    text-align: center;
    font-family: 'Roboto', sans-serif;
    margin-top: 31px;


}


    .product:hover {
    transform: translateY(-10px);
    }

    .product img {
    display: block;
    height: 100%;
    margin: 0 auto;

}

    .product-info {
    padding: 20px;
    text-align: left;
    }

    .product .name {
    margin-top: 10px;
    font-weight: normal;
    font-size: 1.2rem;
    text-align: left;
}

.product .price {
    margin-top: 5px;
    font-size: 1.2rem;
    font-weight: bold;
    color: #007aff;
    text-align: left;
}

    .product-description {
    font-size: 1rem;
    color: #666;
    }

    .carousel-item img {
  height: 700px;
  width: 100%;
  object-fit: cover;
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
    .categories {
    text-align: center;
    padding: 20px;
}

.categories h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #333;
}

.category-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
}

.category {
    text-align: center;
    flex: 1 1 calc(16.66% - 20px);
    max-width: calc(16.66% - 20px);
}

.category a {
    text-decoration: none; /* Removes underline */
}

.category img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.9s ease;
}

.category img:hover {
    transform: scale(1.1);
}

.category span {
    display: block;
    margin-top: 10px;
    font-size: 1.2rem;
    color: #333;
    font-weight: bold;
}

.categories h1 {
    font-family: 'Roboto', sans-serif;  
    font-weight: 300;  
    font-size: 23px;  
    color: #333;  
    text-align: left;  
    margin-bottom: 38px;  
    margin-left: 339px;
    margin-top: 38px;
}


.link-icons, .auth-links {
    display: flex;
    align-items: center;
}

.auth-links {
    margin-left: 33px; /* Push login to the far right */
}

.auth-links a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    transition: color 0.3s ease;
}

.auth-links a:hover {
    color: #00afff; /* Add hover effect */
}
</style>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link href="public/css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>



         
        <main>
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- First Image -->
        <div class="carousel-item active" data-bs-interval="3000">
            <img src="public/images/po_iphone.png" class="d-block w-100" alt="iPhone">
            <div class="carousel-caption d-none d-md-block">
                <!-- Optional caption -->
            </div>
        </div>
        <!-- Second Image -->
        <div class="carousel-item" data-bs-interval="3000">
            <img src="public/images/featured-image.jpg" class="d-block w-100" alt="AirPods">
            <div class="carousel-caption d-none d-md-block">
                <!-- Optional caption -->
            </div>
        </div>
        <!-- Third Image -->
        <div class="carousel-item" data-bs-interval="3000">
            <img src="public/images/smarttv.jpg" class="d-block w-100" alt="Samsung TV">
            <div class="carousel-caption d-none d-md-block">
                <!-- Optional caption -->
            </div>
        </div>
        <!-- Fourth Image -->
        <div class="carousel-item" data-bs-interval="3000">
            <img src="public/images/lg-signature-kitchen.jpg" class="d-block w-100" alt="Refrigerator">
            <div class="carousel-caption d-none d-md-block">
                <!-- Optional caption -->
            </div>
        </div>
    </div>
    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="categories">
<h1>Categories</h1>
    <div class="category-container">
       
        <!-- Cellphone Category -->
        <div class="category">
            <a href="index.php?page=home/category&category=mobile">
                <img src="public/images/imgs/phone.png" alt="Cellphone">
            </a>
            <span>Cellphone</span>
        </div>
        
        <!-- Television Category -->
        <div class="category">
            <a href="index.php?page=home/category&category=television">
                <img src="public/images/imgs/TV.png" alt="Television">
            </a>
            <span>TV</span>
        </div>
        
        <!-- Air Condition Category -->
        <div class="category">
            <a href="index.php?page=home/category&category=aircondition">
                <img src="public/images/imgs/aircon.png" alt="Air Condition">
            </a>
            <span>Air Condition</span>
        </div>
        
        <!-- Home Appliances Category -->
        <div class="category">
            <a href="index.php?page=home/category&category=homeappliances">
                <img src="public/images/imgs/stove.png" alt="Home Appliances">
            </a>
            <span>Home Appliances</span>
        </div>
    </div>
</div>

<div class="recentlyadded content-wrapper">
    <h2>EXCLUSIVE PRODUCTS</h2>
    <div class="products">
        <?php if (!empty($recently_added_products)): ?>
            <?php foreach ($recently_added_products as $product): ?>
                <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
                    <img src="public/images/imgs/<?=$product['image_url']?>" width="200" height="200" alt="<?=$product['product_name']?>">
                    <span class="product_name"><?=$product['product_name']?></span>
                    <span class="price">
                        &#8369;<?=$product['price']?>
                    </span>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</div>

                


            <?=template_footer()?>