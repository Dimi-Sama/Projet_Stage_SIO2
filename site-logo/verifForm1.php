<?php
$sec = hash('sha256',$_SERVER['REMOTE_ADDR']);
setcookie("session",$sec,time()+900,"/");

if(!isset($_POST['secteur']) || !isset($_COOKIE['CooName'])){
    header("Location: form-1.php?false=TRUE");
}else{
    $secteur = $_POST['secteur'];

setcookie("CooSecteur",$secteur[0],time()+900,"/");

header("Location: form-2.php");
}

?>