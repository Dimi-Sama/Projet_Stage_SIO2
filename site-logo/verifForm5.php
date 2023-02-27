<?php
if(!isset($_POST['forfait'])){
    header("Location: form-5.php?false=TRUE");
}else {
    $forfait = intval($_POST['forfait']);
    if ($forfait == 1) {
        setcookie("CooIdStripe","",time()+900,"/"); //Mette l' id du produit crée dans Stripe
    }elseif ($forfait == 3) {
        setcookie("CooIdStripe","",time()+900,"/"); //Mette l' id du produit crée dans Stripe
    }elseif ($forfait == 4) {
        setcookie("CooIdStripe","",time()+900,"/"); //Mette l' id du produit crée dans Stripe
    }

setcookie("CooForfait",$forfait,time()+900,"/");

header("Location: form-val.php");

}

?>