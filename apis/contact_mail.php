<?php

$toEmail = "info@sandiagroup.com";
$mailHeaders = "From: " . $_POST["contact-name"] . "<". $_POST["contact-email"] .">\r\n";

if(mail($toEmail, $_POST["subject"], $_POST["message"], $mailHeaders)) {
    print "<p class='success'>Contact Mail Sent.</p>";
} else {

    print "<p class='Error'>Problem in Sending Mail.</p>";
}