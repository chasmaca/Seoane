<?php
// $mail = new PHPMailer;

// $mail->SMTPDebug = 2;
// $mail->IsSMTP();
// $mail->Host = "smtp.dominioabsoluto.net";
// $mail->SMTPAuth = true;

// $mail->SMTPSecure = "tls";
// $mail->Username = "info@elpartedigital.com";
// $mail->Password = "Elparte2017!";
// $mail->Port = "587";
/**
 * This example shows making an SMTP connection without using authentication.
*/

date_default_timezone_set('Etc/UTC');
require 'phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
	
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "chasmaca@gmail.com";
$mail->Password = "M@rI0&R@9u1";
$mail->SetFrom("chasmaca@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("chasmaca@gmail.com");

if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	//echo "Message has been sent";
}


?>