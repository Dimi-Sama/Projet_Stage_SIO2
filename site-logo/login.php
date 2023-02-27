<?php session_start(); ?>
<?php

if (!isset($_POST["txtId"]) && !isset($_POST["txtMdp"]) ) {	
    header("Location: index.php");
    exit();
} else {


    $user = $_POST["txtUser"];	
    $mdp = $_POST["txtMdp"];
    require "lib/dbConnect.php";
    $bd = new DbConnect();
    $conn = $bd->connect();

    $sql = "SELECT * FROM admin WHERE user = :user";
        // Pour éviter les injections SQL
        $result = $conn->prepare($sql);			
        $result->bindparam(':user',$user);
        $result->execute();          
        $line = $result->fetch();
        
if (!$line) {
    // Utilisateur non trouvé ($line ne contient pas d'enregistrement)
    header("Location: form-admin.php?emty=TRUE");
} else {
    // Utilisateur trouvé
    $mdpBD = $line['mdp'];
    if(password_verify($mdp,$mdpBD)) {
        $_SESSION['Admin'] = true;
    
        // Mémorisation des infos utilisateur
        $_SESSION["User"] = $line['user']; 
        header("Location: admin/style.php");
    }else {
        header("Location: form-admin.php?erreur=TRUE");
    }

}
}	

?>