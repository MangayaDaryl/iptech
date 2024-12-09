<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Corrected paths for PHPMailer files
require __DIR__ . '/../vendor/phpmailer/src/Exception.php';
require __DIR__ . '/../vendor/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $fullName = $_POST["full_name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $cardNumber = $_POST["card_number"];
    $subtotal = $_POST["subtotal"];

    $maskedCardNumber = "************" . substr($cardNumber, -4);

    try {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sia.mangaya.daryl@gmail.com'; // Replace with your email
        $mail->Password = 'uonggldfattbtezx'; // Replace with your email password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('sia.mangaya.daryl@gmail.com', 'IPTech'); // Replace with your email
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Payment Confirmation - IPTech';
        $mail->Body = "
            <h1>Payment Successful!</h1>
            <p>Hi <strong>$fullName</strong>, Your payment was successfully processed. Please see below for the transaction details.</p>
            <p><strong>Card Number: </strong>$maskedCardNumber</p>
            <p><strong>Amount:</strong> &#8369;" . number_format($subtotal, 2) . "</p>
            <p><strong>Address:</strong> $address</p>
            <p>We appreciate your business with IPTech!</p>
        ";

        $mail->send();
        echo "<script>
                alert('Payment receipt sent successfully to $email');
                window.location.href = 'payment.php';
              </script>";
    } catch (Exception $e) {
        echo "<script>
                alert('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');
                window.location.href = 'payment.php';
              </script>";
    }
}
?>
