<?php

include 'includes/database.php';

$pdo = pdo_connect_mysql();

// Directories for views and models
$views_dir = 'views/';
$models_dir = 'app/Model/';
$controllers_dir = 'app/Controllers/';  // New directory for controllers

// Set default page to 'home', otherwise use the 'page' parameter
$page = isset($_GET['page']) && (
    file_exists($views_dir . $_GET['page'] . '.php') || 
    file_exists($models_dir . $_GET['page'] . '.php') ||
    file_exists($controllers_dir . $_GET['page'] . '.php')
) ? $_GET['page'] : 'home';



// Include view or controller
if (file_exists($views_dir . $page . '.php')) {
    include $views_dir . $page . '.php';
} elseif (file_exists($models_dir . $page . '.php')) {
    include $models_dir . $page . '.php';
} elseif (file_exists($controllers_dir . $page . '.php')) {
    // Load the controller file
    include $controllers_dir . $page . '.php';
} else {
    echo 'Error: Page not found.';
}
?>
