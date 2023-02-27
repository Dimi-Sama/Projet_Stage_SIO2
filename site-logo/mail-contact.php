<?php

//Include required PHPMailer files
require 'lib/PHPMail/PHPMailer.php';
require 'lib/PHPMail/SMTP.php';
require 'lib/PHPMail/Exception.php';
require "lib/dbConnect.php";

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




//Create instance of PHPMailer
$mail = new PHPMailer();
//Set mailer to use smtp
$mail->isSMTP();
//Define smtp host
$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "tls";
//Port to connect smtp
$mail->Port = "587";
//Set gmail username
$mail->Username = ""; //Mettre l'adresse mail 
//Set gmail password
$mail->Password = ""; //Mettre la clé d'application Google
//Email subject
$mail->Subject = $_POST["sujet"];
//Set sender email
$mail->setFrom($_POST['email'], $_POST['email'] . " - " . $_POST['nom']);
//Enable HTML
$mail->isHTML(true);
// //Attachment
// 	$mail->addAttachment('img/attachment.png');
//Email body
$mail->Body = $_POST['message'];
//Add recipient
$mail->addAddress(""); //Mettre l'adresse qui va recevoir les contacts
//Finally send email
if ($mail->send()) {
	$mail->smtpClose();
	header("Location: form-contact.php?send=TRUE");
} else {
	$mail->smtpClose();
	header("Location: form-contact.php?send=FALSE");
}
//Closing smtp connection
