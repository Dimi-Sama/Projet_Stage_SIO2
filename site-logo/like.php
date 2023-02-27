<?php
require "lib/dbConnect.php";
$bd = new DbConnect();
$conn = $bd->connect();
if (!isset($_GET['idUser'],$_GET['numCom'])) {
    header("Location: galerie.php");
}else {

    $idUser = $_GET['idUser'];
    $numCom = $_GET['numCom'];
    
    if (!isset($_GET['like']) || empty($_GET['like'])) {
    $sql = "INSERT INTO likes (id,numCommande,idUser) VALUES (NULL, :numCommande,:idUser)";
    $req = $conn->prepare($sql);
    $req->bindParam(':numCommande',$numCom);
    $req->bindParam(':idUser',$idUser);
    $req->execute();
    header("Location: galerie.php");
    }else {
    $sql = "DELETE FROM likes  WHERE numCommande = :numCommande and idUser = :idUser";
    $req = $conn->prepare($sql);
    $req->bindParam(':numCommande',$numCom);
    $req->bindParam(':idUser',$idUser);
    $req->execute();
    header("Location: galerie.php");
    }
}
?>