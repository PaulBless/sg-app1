<?php

// send contact form mail using in-build PHP Mail Function
$contactName = rtrim($_POST['contact-name']);
$contactEmail = rtrim($_POST['contact-email']);
$contactPhone = rtrim($_POST['contact-phone']);
$message = rtrim($_POST['message']);
$subject = rtrim($_POST['subject']);

// prepare email body text
$body = "Name: " . $contactName . "\n";
$body .= "Email: " . $contactEmail . "\n";
$body .= "Phone: " . $contactPhone . "\n";
$body .= "Message: " . $message . "\n";
$body .= "Subject: " . $subject . "\n";

// send email
$toEmail = "info@sandiagroup.com";
$mailHeaders = "From: " . $contactName . "<". $contactEmail .">\r\n";

if(mail($toEmail, $subject, $body, $mailHeaders)) {
    print "<p class='success'>Contact Mail Successfully Sent.</p>";
} else {
    print "<p class='Error'>Problem in Sending Mail.</p>";
}

