<?php
session_start();

// Clear the session cookie
setcookie(session_name(), '', time() - 3600, '/');  // Expire the session cookie

// Destroy session variables and session
session_unset();
session_destroy();

// Redirect to index.php after logout
header('Location: /index.php');
exit();
?>
