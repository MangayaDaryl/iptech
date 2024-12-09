<?php
    $title = "Category Page"; // Set the page title
    include('header.php'); // Assuming you have a header file for common HTML structures
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">



    <nav class="custom-nav">
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link text-dark font-weight-medium" href="index.php?page=home/category&category=mobile">Cellphone</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark font-weight-medium" href="index.php?page=home/category&category=television">Television</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark font-weight-medium" href="index.php?page=home/category&category=aircondition">Air Condition</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark font-weight-medium" href="index.php?page=home/category&category=homeappliances">Home Appliances</a>
        </li>
    </ul>
</nav>



<style>
    /* Change background color of the custom nav */
    .custom-nav {
        background-color: #fff; /* Light grey background */
        margin: 17px;
        box-shadow: 0 0 0 17px #fff; /* Example colored margin */
    }

    /* Optional: Styling for individual nav links */
    .custom-nav .nav-link {
        color: #333; /* Change the text color */
    }

    /* Optional: Hover effects */
    .custom-nav .nav-link:hover {
        background-color: #e4eef05e; /* Change background on hover */
        color: #000; /* Change text color on hover */
    }

    /* Active nav link style */
    .custom-nav .nav-pills .nav-link.active {
        background-color: #007bff; /* Change color for active item */
    }
    .font-weight-medium {
    font-weight: 500; /* Medium bold */
    
}

</style>


</head>
<body>
    <div class="container mt-5">
      
        <!-- Horizontal Navigation Menu -->
       

        <?php
            // Get the category from the query string
            if (isset($_GET['category'])) {
                $category = $_GET['category'];
            
                // Map categories to their respective file paths
                $category_map = [
                    'mobile' => 'views/Home/mobile.php',
                    'television' => 'views/Home/television.php',
                    'aircondition' => 'views/Home/aircondition.php',
                    'homeappliances' => 'views/Home/homeappliances.php',
                ];
            
                // Check if the category exists in the map
                if (array_key_exists($category, $category_map)) {
                    include($category_map[$category]);
                } else {
                    echo "<p>Category not found.</p>"; // Display a message if no valid category is selected
                }
            }
        ?>
    </div>

  </body>
</html>
