<?php
if(!isset($_POST['style'])){
    header("Location: form-4.php?false=TRUE");
}else {
    $splitStyle = "";
    $style = $_POST['style'];
    foreach ($style as $col) {
        $splitStyle = $splitStyle . $col . "/" ;
   
   }
setcookie("CooStyles",$splitStyle,time()+900,"/");
header("Location: form-5.php");
}

?>