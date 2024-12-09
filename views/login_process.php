<?php
session_start();
include '../includes/database.php';

// Assume the form was submitted and email & password are provided
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email exists in the database
$stmt = $pdo->prepare('SELECT * FROM users_tbl WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    // Successful login
    $_SESSION['user_email'] = $user['email']; // Store user email in session
    $_SESSION['user_id'] = $user['user_id']; // Store user_id in session

    // Check if the user is an admin (assuming 'is_admin' is a column in the users_tbl)
    if ($user['is_admin'] == 1) {
        $_SESSION['is_admin'] = true;
        header('Location: ../views/admin_dashboard.php'); // Redirect to the admin dashboard
    } else {
        $_SESSION['is_admin'] = false;
        header('Location: ../index.php'); // Redirect to the homepage or user profile
    }
    exit();
} else {
    // Login failed
    $_SESSION['error'] = 'Invalid email or password';
    header('Location: ../views/loginpage.php'); // Redirect back to the login page
    exit();
}
