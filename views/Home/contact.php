<?php
session_start();
include('header.php');  // Ensure this file contains the PDO connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email_address']);
    $message = htmlspecialchars($_POST['message']);
    $agree = isset($_POST['agree']) ? 1 : 0;

    // Basic validation
    if (!$name || !$email || !$message || !$agree) {
        $error = "Please fill all required fields and agree to the terms.";
    } else {
        // Insert feedback into the database (only the required fields)
        $stmt = $pdo->prepare("INSERT INTO feedbacks (full_name, email_address, message, agree) 
                               VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $message, $agree]);

        // Send email to admin
        $adminEmail = "admin@gmail.com";  // Change this to the admin's email address
        $subject = "New Feedback Submission from $name";
        $body = "
        New Feedback Submission:

        Name: $name
        Email: $email
        Message: $message
        ";

        // Set headers for email
        $headers = "From: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Send email
        $emailSent = mail($adminEmail, $subject, $body, $headers);

        if ($emailSent) {
            $success = "Thank you for your feedback! Your feedback has been sent successfully.";
        } else {
            $error = "Sorry, something went wrong while sending your feedback. Please try again.";
        }

        // Redirect to avoid form resubmission
        if (empty($error)) {
            header("Location: contact.php?success=1");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        textarea {
            height: 120px;
        }

        .buttons {
            text-align: center;
        }

        .buttons input {
            background-color: #007aff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .buttons input:hover {
            background-color: #0056c1;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .success {
            color: green;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <p>Your feedback is important to us! Please fill out the form below.</p>

        <?php if (isset($_GET['success'])): ?>
            <div class="success">Feedback sent successfully!</div>
        <?php elseif (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <form method="post" action="contact.php">
            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" id="full_name" name="full_name" placeholder="Your full name" required>
            </div>
            <div class="form-group">
                <label for="email_address">Email Address *</label>
                <input type="email" id="email_address" name="email_address" placeholder="Your email address" required>
            </div>
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" placeholder="Your message" required></textarea>
            </div>
            <div class="form-group">
                <input type="checkbox" id="agree" name="agree" required>
                <label for="agree">I agree to the terms and conditions</label>
            </div>
            <div class="buttons">
                <input type="submit" value="Submit Feedback">
            </div>
        </form>
    </div>
</body>
</html>
