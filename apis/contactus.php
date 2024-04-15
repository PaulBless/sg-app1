<?php

// post data
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

// 
$toEmail = "eshunbless1@gmail.com";

$mailHeaders = "From: " . $_POST["contact-name"] . "<". $_POST["contact-email"] .">\r\n";

if(mail($toEmail, $_POST["subject"], $_POST["message"], $mailHeaders)) {
    print "<p class='success'>Contact Mail Sent.</p>";
} else {
    print "<p class='Error'>Problem in Sending Mail.</p>";
}
