<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactname = $_POST['name'] ?? '';
    $contactemail = $_POST['email'] ?? '';
    $contactnumber = $_POST['number'] ?? '';
    $contactmessage = $_POST['Date'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'manimalladi05@gmail.com'; // your Gmail address
        $mail->Password   = 'gqetcnlslqnxzspm'; // your Gmail App Password (NOT normal password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use implicit SSL encryption
        $mail->Port       = 465; // Port for SSL

        // Optional (if SSL verification causes error)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ],
        ];

        // Recipients
        $mail->setFrom('manimalladi05@gmail.com', '');
        $mail->addAddress('manimalladi05@gmail.com', '');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body    = "
            <h1>Contact Details</h1>
            <p><strong>Name:</strong> $contactname</p>
            <p><strong>Email:</strong> $contactemail</p>
            <p><strong>Number:</strong> $contactnumber</p>
            <p><strong>Date</strong> $contactmessage</p>
        ";

        $mail->send();
        echo '<script>alert("Message has been sent successfully."); window.location.href="index.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Access Denied';
}