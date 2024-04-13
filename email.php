<?php
session_start();
// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
require 'vendor/autoload.php'; // Assuming you have PHPMailer library installed via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'wdcom666@gmail.com';
    $mail->Password = 'sabdbgqsbafedgsp';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('wdcom666@gmail.com');
    $mail->addAddress('wdcom666@gmail.com', 'Rajan');

    $mail->Subject = 'Hello';
    $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";
    
    $mail->send();
    echo 'Form submited successfully.';
} catch (Exception $e) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
// Regenerate CSRF token for the next form submission
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>