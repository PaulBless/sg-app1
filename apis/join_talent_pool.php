<?php

/**
 * @Author: Paul Eshun
 * @Date:   14-04-2024
 * @Email:   eshunbless1@gmail.com
 * @website: https://iampaul.netlify.app
 */

// Include PHPMailer autoload file
require('phpmailer/class.phpmailer.php');

// post data
$senderName = $_POST['fullName'];
$senderEmail = $_POST['emailAddress'];
$senderPhone = $_POST['phoneNumber'];
$senderLocation = $_POST['location'];
$senderQualification = $_POST['qualification'];
$senderMotivation = $_POST['motivation-letter'];
$talentCV = $_FILES['cvFile']['name'];

// Email parameters
$toEmail = 'info@sandiagroup.com';
$subject = 'Talent Pool - New talent prospect received from  Sandia Group website.';
$body = <<<EOT
    Name: {$_POST['fullName']}
    Phone Number: {$_POST['phoneNumber']}
    Email: {$senderEmail}
    Location: {$_POST['location']}
    Motivation: {$_POST['motivation-letter']}
    EOT;;

    $attachmentPath = 'path/to/attachment/file.pdf'; // Replace with the path to cv file

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.sandiagroup.com';  // Your SMTP host
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->Username = 'info@sandiagroup.com'; // Your SMTP username
    $mail->Password = 'smtp_password'; // Your SMTP password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content
    $mail->setFrom($senderEmail, $senderName); // Sender email and name
    $mail->addAddress($toEmail); // Recipient email
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->addAttachment($_FILES['cvFile']['tmp_name'],$_FILES['cvFile']['name']); // Attach the file

    // Send email
    $mail->send();
    echo json_encode(array('success' => true, 'message' => 'Email sent successfully', 'status' => 200));

} catch (Exception $e) {
    // echo 'Error: ' . $mail->ErrorInfo;
    echo json_encode(array('success' => false, 'message' => 'Could not process your request. \n' .$mail->ErrorInfo, 'status' => 400));
}

