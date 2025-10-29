<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactname = $_POST['name'] ?? '';
    $contactemail = $_POST['email'] ?? '';
    $contactnumber = $_POST['number'] ?? '';
    $appointment_datetime = $_POST['appointment_datetime'] ?? ''; // ✅ Correct field name

    // Format the date & time (optional)
    if (!empty($appointment_datetime)) {
        $formattedDate = date("d M Y, h:i A", strtotime($appointment_datetime));
    } else {
        $formattedDate = "Not selected";
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'manimalladi05@gmail.com'; // Your Gmail address
        $mail->Password   = 'gqetcnlslqnxzspm'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption
        $mail->Port       = 465; // Port for SSL

        // Optional: disable strict SSL verify (helps on localhost)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ],
        ];

        // Recipients
        $mail->setFrom('manimalladi05@gmail.com', 'Ivy Dental Hospital');
        $mail->addAddress('manimalladi05@gmail.com', 'Ivy Dental Hospital');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Booking';
        $mail->Body    = "
            <h1>Appointment Details</h1>
            <p><strong>Name:</strong> $contactname</p>
            <p><strong>Email:</strong> $contactemail</p>
            <p><strong>Number:</strong> $contactnumber</p>
            <p><strong>Appointment Date & Time:</strong> $formattedDate</p>
        ";

        $mail->send();
        echo '<script>alert("Appointment details sent successfully!"); window.location.href="index.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Access Denied';
}
