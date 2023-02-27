<?php
    print_r($_POST['couleur']);

if(!isset($_POST['couleur'])){
    header("Location: form-3.php?false=TRUE");
}else {
    $splitCouleur = '';
    $couleur = $_POST['couleur'];
    foreach ($couleur as $col) {
        if ($col == "on") {
            setcookie("CooCustomCo",$_POST['custom-color'],time()+900,"/");
        }
     $splitCouleur = $splitCouleur . $col . "/" ;

}
setcookie("CooCouleur",$splitCouleur,time()+900,"/");
header("Location: form-4.php");
}

?>