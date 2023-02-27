<?php

if(empty($_POST['prenom']) || empty($_POST['username']) || empty($_POST['mdp']) || empty($_POST['email']) || empty($_POST['numTel'])){
    header("Location: form-reg.php?emty=TRUE");
}else{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $mdp = password_hash($_POST['mdp'],PASSWORD_ARGON2I);
    $email = $_POST['email'];
    $numTel = $_POST['numTel'];
    $adrRue = $_POST['adrRue'];
    $ville = $_POST['ville'];
    $codeP = $_POST['codeP'];

    require "lib/dbConnect.php";
    $bd = new DbConnect();
    $conn = $bd->connect();

    $sql = "INSERT INTO users (id,mdp,nom,prenom, username, mail, numTel,adrRue,ville,codePostal) VALUES (NULL,:mdp, :nom, :prenom, :username, :email, :numTel,:adrRue,:ville,:codePostal)";
        // Pour éviter les injections SQL
        $result = $conn->prepare($sql);			
        $result->bindParam(':mdp', $mdp);
        $result->bindParam(':nom', $nom);
        $result->bindParam(':prenom', $prenom);
        $result->bindParam(':username', $username);
        $result->bindParam(':email', $email);
        $result->bindParam(':numTel', $numTel);
        $result->bindParam(':adrRue', $adrRue);
        $result->bindParam(':ville',$ville);
        $result->bindParam(':codePostal',$codeP);			
        if ($result->execute()) {
            header("Location: form-login.php");
        }else {
            header("Location: form-req.php?erreur=TRUE");
        }

    }	

?>