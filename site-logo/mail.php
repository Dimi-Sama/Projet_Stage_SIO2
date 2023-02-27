<?php

//Include required PHPMailer files
require 'lib/PHPMail/PHPMailer.php';
require 'lib/PHPMail/SMTP.php';
require 'lib/PHPMail/Exception.php';
require "lib/dbConnect.php";
$bd = new DbConnect();
$conn = $bd->connect();
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$user = $_COOKIE['CooUser'];
$sql = "SELECT mail FROM users WHERE id = :user";
// Pour éviter les injections SQL
$result = $conn->prepare($sql);
$result->bindparam(':user', $user);
$result->execute();
$test = $result->fetch(PDO::FETCH_ASSOC);

$userMail = $test['mail'];


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
$mail->Subject = "Votre commande de logo";
//Set sender email
$mail->setFrom('notice@getalogo.fr', "Get A Logo");
//Enable HTML
$mail->isHTML(true);
// //Attachment
// 	$mail->addAttachment('img/attachment.png');
//Email body
$mail->Body = "<h1>Votre commande de logo</h1></br><h2>Merci de votre achat chez Get a Logo</h2> <br>   
	<p>Vous pouvez consulter vos commandes via le bout ton ci-dessous </p>
	<br>    
	<a href='http://localhost/backoffice_login_php/site-logo/userManage/seeCommande.php' style='box-shadow: 3px 4px 0px 0px #000000;
	background:linear-gradient(to bottom, #000000 5%, #755e75 100%);
	background-color:#000000;
	border-radius:18px;
	border:1px solid #000000;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:17px;
	padding:7px 25px;
	text-decoration:none;
	text-shadow:0px 1px 0px #000000;'>Mes commandes</a> ";
//Add recipient
$mail->addAddress($userMail);
//Finally send email
if ($mail->send()) {
	header("Location: success.php");
} else {
	echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
}
//Closing smtp connection
$mail->smtpClose();
