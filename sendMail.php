<?php

require 'utiles/phpmailer/PHPMailerAutoload.php';

/**
 * This example shows making an SMTP connection without using authentication.
*/
//Import the PHPMailer class into the global namespace

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

try{

	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	//$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "limpiezaarosa@gmail.com";
	$mail->Password = "Acceso01";
	$mail->SetFrom("example@gmail.com");
	$mail->Subject = "Test";
	$mail->Body = "hello";
	$mail->AddAddress("chasmaca@gmail.com");
	
	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message has been sent";
	}
	
} catch (Exception $e) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>