<?php

/**
 * @Author: Paul Eshun
 * @Date:   14-04-2024
 * @Email:   eshunbless1@gmail.com
 * @website: https://iampaul.netlify.app
 */

if (isset($_POST['fullName']) 
    && isset($_POST['emailAddress']) 
    && isset($_POST['appointmentDate']) 
    && isset($_POST['discussionTitle']) 
    && isset($_POST['bookingMessage'])) {

    // get post data
    $fullName = $_POST['fullName'];
    $senderEmail = $_POST['emailAddress'];
    $phone = $_POST['phoneNumber'];
    $location = $_POST['location'];
    $appointmentDate = $_POST['appointmentDate'];
    $discussionTitle = $_POST['discussionTitle'];
    $content = $_POST['bookingMessage'];

    // set email content or data
    $body = '<b>Name: </b>'.$fullName.PHP_EOL;
    $body = 'Phone Number: '.$fullName.PHP_EOL;
    $body .= 'Email: '.$email.PHP_EOL;
    $body .= 'Location: '.$location.PHP_EOL;
    $body .= 'Appointment Date: '.$appointmentDate.PHP_EOL;
    $body .= 'Discussion Title: '.$discussionTitle.PHP_EOL;
    $body .= 'Message: '.$content.PHP_EOL;

    $replyto = $receiveMail = 'info@sandiagroup.com';
    
    // headers
    $header = "From: ".$fullName." <".$senderEmail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    
    // message 
    $nmessage = "--".$uid."\r\n";
    $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $nmessage .= $body."\r\n\r\n";
    $nmessage .= "--".$uid."\r\n";
    $nmessage .= $content."\r\n\r\n";
    $nmessage .= "--".$uid."--";

    try {
        $subject = 'New Appointment Booking from Sandia Group Website.';
        mail($receiveMail, $subject, $nmessage, $header);
        echo json_encode(
            [
                'message' => 'Your appointment is booked, we\'ll reach out to you, thank you!',
                'flag' => '1',
                'code' => 200
            ]
        );
    } catch (Exception $e) {
        echo json_encode(
            [
                'message' => 'There is an error booking your appointment: '.$e->getMessage().'\nPlease try to submit again.',
                'flag' => '0',
                'code' => 400
            ]
        );
    }
} else {
    echo json_encode(
        [
            'message' => 'Something went wrong, fill all required fields',
            'flag' => '0',
            'code' => 404
        ]
    );
}