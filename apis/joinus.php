<?php

require('phpmailer/class.phpmailer.php');

// post data
$senderName = $_POST['fullName'];
$senderEmail = $_POST['emailAddress'];
$senderPhone = $_POST['phoneNumber'];
$senderLocation = $_POST['location'];
$senderQualification = $_POST['qualification'];
$senderMotivation = $_POST['motivation-letter'];
$talentCV = $_FILES['cvFile']['name'];
$subject = 'Talent Pool - New talent prospect received from  Sandia Group website.';

// email content
$emailContent = "
<html>
<head>
<title>New Talent Application</title>
</head>
<body>
<p>Name: $senderName</p>
<p>Email: $senderEmail</p>
<p>Phone: $senderPhone</p>
<p>Location: $senderLocation</p>
<p>Qualification: $senderQualification</p>
<p>Motivation Letter: $senderMotivation</p>
<p>CV: $talentCV</p>
</body>
</html>";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "Your SMTP UserName";
$mail->Password = "Your SMTP Password";
$mail->Host     = "Your SMTP Host";
$mail->Mailer   = "smtp";
$mail->SetFrom($senderEmail, $senderName);
$mail->AddReplyTo($senderEmail, $senderName);
$mail->AddAddress("info@sandiagroup.com");	
$mail->Subject = $subject;
$mail->WordWrap = 80;
$mail->MsgHTML($_POST["motivation-letter"]);

if(is_array($_FILES)) {
	$mail->AddAttachment($_FILES['cvFile']['tmp_name'],$_FILES['cvFile']['name']); 
}

$mail->IsHTML(true);

if(!$mail->Send()) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Mail not sent, something went wrong. Try later.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';

} else {
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Thanks!</strong> Your message was sent successfully, we will get back soon.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
}	
