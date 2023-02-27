<?php

//Include required PHPMailer files
require '../../lib/PHPMail/PHPMailer.php';
require '../../lib/PHPMail/SMTP.php';
require '../../lib/PHPMail/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'dbConnect.php';
$bd = new DbConnect();
$conn = $bd->connect();



if(isset($_POST['updateCommande']))
{
    $idCommande = $_POST['idCommande'];
    $etat = $_POST['idEtat'];
    if (!file_exists($_FILES['imageFinal']['tmp_name']) || !is_uploaded_file($_FILES['imageFinal']['tmp_name'])) {
        $logoFinal = "";
    }else {
        $logoFinal = $_FILES["imageFinal"]["name"];
    }

    $sql = "UPDATE commandes SET idEtat = :etat, logoFinal = :logoFinal WHERE numero= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idCommande);
    $req->bindParam(':etat',$etat);
    $req->bindParam(':logoFinal',$logoFinal);
    if($req->execute()) {
        mailUser($idCommande,$etat);
        $repImg = '../../../asset/imgLogoFinal/';
        $logoFinal = $_FILES["imageFinal"]["name"];
        move_uploaded_file($_FILES['imageFinal']['tmp_name'], $repImg . $logoFinal);
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}


if(isset($_GET['idCommande']))
{
    $idCommande = $_GET['idCommande'];

    $sql = "SELECT * FROM commandes WHERE numero = :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idCommande);
    $req->execute();
    if($req->rowCount() == 1)
    {
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $res = [
            'status' => 200,
            'message' => 'Commande trouvé',
            'data' => $result
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Comamnde Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['deleteCommande']))
{
    $idCommande = $_POST['idCommande'];

    $sql = "DELETE FROM commandes WHERE numero= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idCommande);
    if($req->execute()) {
        $response = ['status' => 1, 'message' => 'Success'];
    }else {
        $response = ['status' => 2, 'message' => 'Fail'];
    }
    echo json_encode($response);
    return;
}

function mailUser($idCommande,$idEtat){

    global $conn;

    $sql = "SELECT libelle FROM etat WHERE id= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idEtat);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);

    $etatLib = $result['libelle'];

    $sql = "SELECT idUser FROM commandes WHERE numero= :id";
    $req = $conn->prepare($sql);
    $req->bindParam(':id',$idCommande);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);

    $idUser = $result['idUser'];

    $sql = "SELECT mail FROM users WHERE id = :user";
	// Pour éviter les injections SQL
	$result = $conn->prepare($sql);			
	$result->bindparam(':user',$idUser);
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
        $mail->setFrom('notice@getalogo.fr',"Get A Logo");
    //Enable HTML
        $mail->isHTML(true);
    // //Attachment
    // 	$mail->addAttachment('img/attachment.png');
    //Email body
        $mail->Body = "<h1>Votre commande de logo</h1></br><h2>Votre commande est actuellement : " . $etatLib . "</h2> <br>   
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
        text-shadow:0px 1px 0px #000000;'>Mes commandes</a> " ;
    //Add recipient
        $mail->addAddress($userMail);

        $mail->send();
    //Closing smtp connection
        $mail->smtpClose();
}

?>