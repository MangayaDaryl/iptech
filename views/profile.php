<?php
session_start(); // Start the session


// Include the database connection
require_once('../includes/database.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: loginpage.php");
    exit();
}

// Get the user information from the session
$user_id = $_SESSION['user_id'];

try {
    // Prepare the query to fetch user details from the database
    $stmt = $pdo->prepare("SELECT * FROM users_tbl WHERE user_id = ?"); // Replace 'user_id' if your column name is different
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If user not found, redirect to the login page
    if (!$user) {
        header("Location: loginpage.php");
        exit();
    }
} catch (PDOException $e) {
    // Log or display the error for debugging purposes
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 1.2rem;
            color: #555;
        }
        .logout-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1.1rem;
            border-radius: 5px;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['email']); ?></h1>
         <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>