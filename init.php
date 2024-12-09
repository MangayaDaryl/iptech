<?php
// Step 1: Include Composer's autoloader
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Models/DatabaseConnection.php';


// Step 2: Start the session for session management (like for cart, user login, etc.)
session_start();

// Step 3: Set default timezone (optional, but recommended)
date_default_timezone_set('America/New_York');

// Step 4: Load environment variables from .env file using vlucas/phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Step 5: Set up error reporting (useful for development)
$app_env = getenv('APP_ENV') ?: 'development'; // Default to 'development' if not set

if ($app_env === 'development') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

// Step 6: Initialize any database connection (if needed)
// Include your database connection file here
require_once __DIR__ . '/src/Models/DatabaseConnection.php';

// Import the DatabaseConnection class
use Models\DatabaseConnection;

// Now, you can use DatabaseConnection class
$database = new DatabaseConnection();
$pdo = $database->connect();
