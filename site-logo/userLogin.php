<?php

if (!isset($_POST["username"]) || !isset($_POST["password"]) || $_POST["username"] == "" || $_POST["password"] =="") {	
    header("Location: form-login.php?emty=TRUE");
    exit();
} else {


    $user = $_POST["username"];	
    $mdp = $_POST["password"];
    require "lib/dbConnect.php";
    $bd = new DbConnect();
    $conn = $bd->connect();

    $sql = "SELECT * FROM users WHERE username = :user";
        // Pour éviter les injections SQL
        $result = $conn->prepare($sql);			
        $result->bindparam(':user',$user);
        $result->execute();          
        $line = $result->fetch();
        
if (!$line) {
    // Utilisateur non trouvé ($line ne contient pas d'enregistrement)
    header("Location: form-login.php?erreur=TRUE");
} else {
    // Utilisateur trouvé
    $mdpBD = $line['mdp'];
    if(password_verify($mdp,$mdpBD)) {
       setcookie("CooUser",$line["id"],time()+3600,"/");
    
       if (isset($_COOKIE['orderWait'])) {
        header("Location: form-val.php");
       }else {
        header("Location: index.php");
       }
    }else {
        header("Location: form-login.php?erreur=TRUE");
    }

}
}	

?>