<?php
// Include the database connection
require_once('../includes/database.php');

// Get the token from the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepare the SQL query to check for the token
    $stmt = $pdo->prepare("SELECT * FROM users_tbl WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Token found, update the user as verified
        $stmt = $pdo->prepare("UPDATE users_tbl SET is_verified = 1 WHERE token = ?");
        $stmt->execute([$token]);

        echo "Your email has been verified! You can now log in.";
    } else {
        echo "Invalid token or token has expired.";
    }
} else {
    echo "No token provided.";
}
?>
