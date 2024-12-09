<?php
// Assuming pdo_connect_mysql() is already included for DB connection
$pdo = pdo_connect_mysql();

// Get the category and filter parameters from the URL
$category = isset($_GET['category']) ? $_GET['category'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Default query to fetch products from the "homeappliances" category
$query = "SELECT * FROM products_tbl WHERE category = 'homeappliances'";

// Add filter condition if the filter is set (for example, 'oven', 'ricecooker', 'stove')
if ($filter) {
    $query .= " AND subcategory = :filter";
}

// Prepare and execute the query
$stmt = $pdo->prepare($query);
if ($filter) {
    $stmt->bindParam(':filter', $filter, PDO::PARAM_STR);
}
$stmt->execute();

// Fetch products
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Title for the page
$title = "Home Appliances";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        /* Change the background color for the entire page */
        body {
            background-color: #f8f9fac2; /* Modify with your desired color */
        }

        /* Optional: Change the background color of product listing */
        .container {
            background-color: #ffffff; /* Modify if you want a different color */
        }
        .mt-8 {
          margin-top: -1.8rem !important;
            
        }

        .col-md-9
        {
            flex: 0 0 33.333333% !important;
        max-width: 24.333333% !important;
    }



        
    </style>



</head>
<body>

<h1 class="text-left mt-8 custom-font-weight"><?php echo $title; ?></h1>





<!-- Filter Form: Pass the filter to the same page (index.php) -->
<form action="index.php" method="get">
   <input type="hidden" name="page" value="home/category">
   <input type="hidden" name="category" value="homeappliances">
   <select name="filter" class="form-control w-25 mx-auto" onchange="this.form.submit()">
       <option value="">Select Product</option>
       <option value="oven" <?php echo ($filter == 'oven') ? 'selected' : ''; ?>>Oven</option>
       <option value="ricecooker" <?php echo ($filter == 'ricecooker') ? 'selected' : ''; ?>>Rice Cooker</option>
       <option value="stove" <?php echo ($filter == 'stove') ? 'selected' : ''; ?>>Stove</option>
   </select>
</form>

<br><br>

<!-- Product Listing -->
<div class="container mt-50 mb-50">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-9 mb-3">
                <div class="card">
                <a href="index.php?page=product&id=<?=$product['id']?>">
    <img src="/public/images/appliances/<?php echo $product['image_url']; ?>" class="card-img-top" alt="<?php echo $product['product_name']; ?>">
</a>
<div class="card-body">
                    <h6 class="media-title font-weight-semibold" style="text-shadow: 0 0 8px #bdbdbd;">
                         <?php echo $product['product_name']; ?>
                        </h6>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <p class="font-weight-semibold " style="font-size: 25px;">
                        ₱<?php echo number_format($product['price'], 2); ?>
                            <a href="index.php?page=product&id=<?=$product['id']?>" class="btn btn-primary text-white custom-btn-padding">Quick View</a>

                        <!-- Add to Cart Form -->
                        <form action="index.php?page=cart" method="post">
                            <input type="hidden" name="product_id" value="<?=$product['id']?>">
                           
                        </form>

                        <!-- Quick View Button -->
                           </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
