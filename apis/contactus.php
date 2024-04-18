<?php

// post data
$contactName = rtrim($_POST['contact-name']);
$contactEmail = rtrim($_POST['contact-email']);
$contactPhone = rtrim($_POST['contact-phone']);
$message = rtrim($_POST['message']). ' - From Sandia Group Website';
$subject = rtrim($_POST['subject']);

// prepare email body text
$body = "Name: " . $contactName . "\n";
$body .= "Email: " . $contactEmail . "\n";
$body .= "Phone: " . $contactPhone . "\n";
$body .= "Subject: " . $subject . "\n";
$body .= "Message: " . $message . "\n";

// 
$toEmail = "eshunbless1@gmail.com";

$mailHeaders = "From: " . $_POST["contact-name"] . "<". $_POST["contact-email"] .">\r\n";

if(mail($toEmail, $_POST["subject"], $body, $mailHeaders)) {
    // print "<p class='text-success'>Contact Mail Sent.</p>";
    echo json_encode(array('status' => 200, 'message' => 'Mail Sent Successfully'));
} else {
    // print "<p class='text-danger'>Problem in Sending Mail.</p>";
    echo json_encode(array('status' => 200, 'message' => 'Mail Sending Error: ' . $mail->ErrorInfo));
    // echo "Mailer Error: " . $mail->ErrorInfo;
}
