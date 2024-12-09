<?php

$pdo = pdo_connect_mysql();

// Query the database for products from the mobile category
$query = "SELECT * FROM products_tbl WHERE category = 'mobile'";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch all products
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Title for the page
$title = "Cellphone";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <!-- You can include your CSS here -->

 
    <style> 
        /* Change the background color for the entire page */
        body {
            background-color: #f8f9fac2; /* Modify with your desired color */
        }

        /* Optional: Change the background color of product listing */
        .container {
            background-color: #ffffff; /* Modify if you want a different color */
        }
        .custom-btn-padding {
    padding: 5px 18px /* Adjust as needed */

}


    </style>



</head>
<body>

<h1 class="text-left mt-5 custom-font-weight"><?php echo $title; ?></h1>




<!-- Product Listing -->
<div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
        <div class="row-md-10">
            <!-- Loop through all products -->
            <?php foreach ($products as $product): ?>
                <div class="card card-body mb-3">
                    <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                        <div class="mr-2 mb-3 mb-lg-0">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
    <img src="/public/images/Mobile/<?php echo $product['image_url']; ?>" width="200" height="200" alt="<?php echo $product['product_name']; ?>">
</a>
 </div>
                        <div class="media-body">
                        <h6 class="media-title font-weight-semibold" style="text-shadow: 0 0 8px #bdbdbd;">
                         <?php echo $product['product_name']; ?>
                        </h6>

                            <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                              
                            </ul>
                            <p class="mb-3"><?php echo $product['description']; ?></p>
                            <p class="font-weight-semibold " style="font-size: 25px;">
                            ₱<?php echo number_format($product['price'], 2); ?>
                            <br>
                            <a href="index.php?page=product&id=<?=$product['id']?>" class="btn btn-primary text-white custom-btn-padding">Quick View</a>

                            <ul class="list-inline list-inline-dotted mb-0">
                             
                            </ul>
                        </div>
                        <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                            
                         
                        <form action="/index.php?page=cart" method="post">
             <input type="hidden" name="product_id" value="<?=$product['id']?>">
                                
                            </form>
                             <!-- Quick View Button -->
                             
      
    </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Include your JS scripts here -->



</body>
</html>