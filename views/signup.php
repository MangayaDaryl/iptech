<?php
session_start(); // Start the session

// Include the database connection and PHPMailer
require_once('../includes/database.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get the input values
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';  // Ensure first name is set
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';  // Ensure last name is set
    $email = isset($_POST['email']) ? $_POST['email'] : '';  // Ensure email is set
    $password = isset($_POST['password']) ? $_POST['password'] : '';  // Ensure password is set

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'All fields are required.';
        header("Location: signup.php"); // Redirect back if fields are missing
        exit();
    }

    // Check if the email already exists
    $stmt = $pdo->prepare("SELECT * FROM users_tbl WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['error'] = 'The email address is already registered.';
        header("Location: signup.php");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Generate a unique token for email verification
    $token = bin2hex(random_bytes(50)); // Create a unique token

    // Prepare SQL query to insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO users_tbl (first_name, last_name, email, password, token, is_verified) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $hashed_password, $token, 0]); // is_verified set to 0 (not verified)

    // Send the verification email
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use SMTP server (can be SMTP2GO or others)
        $mail->SMTPAuth = true;
        $mail->Username = 'sia.mangaya.daryl@gmail.com'; // Your email address
        $mail->Password = 'mtrmsvyrodbnovba';    // Your email app password (if using Gmail with 2FA)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465; // Port for TLS

        // Recipients
        $mail->setFrom('sia.mangaya.daryl@gmail.com', 'IP-Tech');
        $mail->addAddress($email); // Add recipient's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Please verify your email address';
        $mail->Body    = 'Click the link to verify your email: <a href="http://IP-Tech.com/verify.php?token=' . $token . '">Verify Email</a>';

        // Send email
        $mail->send();
    } catch (Exception $e) {
        echo "Failed to send the verification email. Error: {$mail->ErrorInfo}";
    }

    // Redirect to login page after successful sign-up
    header("Location: loginpage.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            text-align: left;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        button {
            background: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #45a049;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Create My Account</h2>
        <p>Please fill in the information below:</p>
        
        <label for="first_name">First name:</label>
        <input type="text" name="first_name" id="first_name" required>
        
        <label for="last_name">Last name:</label>
        <input type="text" name="last_name" id="last_name" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        
        <label>
            <input type="checkbox" name="terms" id="terms" required>
            I agree and consent to the collection, use, or processing of my personal data and agree to the Website's <a href="terms.php">Terms and Conditions</a> and <a href="privacy.php">Privacy Policy</a>.
        </label>
        
        <button type="submit">Create My Account</button>
    </form>
</body>
</html>
