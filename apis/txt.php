<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-06-27 09:58:40
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-06-27 11:24:27
 * @website: http://giaphugroup.com
 */

if (isset($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $country = $_POST['country'];
    $content = $_POST['subject'];
    $body = 'Firstname: '.$firstname.PHP_EOL;
    $body .= 'Lastname: '.$lastname.PHP_EOL;
    $body .= 'Country: '.$country.PHP_EOL;
    $body .= 'Content: '.$content.PHP_EOL;
    $image_name = $_FILES["ypicture"]["name"];
    $image = $_FILES["ypicture"]["tmp_name"];
    $content = file_get_contents($image);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($image_name);
    $replyto = $from_mail = 'reviewgaming2017@gmail.com';
    // header
    $header = "From: ".$firstname." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    // message & attachment
    $nmessage = "--".$uid."\r\n";
    $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $nmessage .= $body."\r\n\r\n";
    $nmessage .= "--".$uid."\r\n";
    $nmessage .= "Content-Type: application/octet-stream; name=\"".$name."\"\r\n";
    $nmessage .= "Content-Transfer-Encoding: base64\r\n";
    $nmessage .= "Content-Disposition: attachment; filename=\"".$name."\"\r\n\r\n";
    $nmessage .= $content."\r\n\r\n";
    $nmessage .= "--".$uid."--";
    try {
        $subject = 'The email was sent from contact form.';
        mail("eshunbless1@gmail.com", $subject, $nmessage, $header);
        echo json_encode(
            [
                'massage' => 'Thank for your contacts',
                'flag' => '1'
            ]
        );
    } catch (Exception $e) {
        echo json_encode(
            [
                'massage' => 'There is a error while sending your contacts: '.$e->getMessage().'\nPlease try to submit again.',
                'flag' => '0'
            ]
        );
    }
}