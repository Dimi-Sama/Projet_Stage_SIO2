<?php
if (!isset($_POST['stLogo'])) {
    header("Location: form-2.php?false=TRUE");
}else {
    $stLogo = $_POST['stLogo'];

    setcookie("CooStyLogo",$stLogo[0],time()+900,"/");
    header("Location: form-3.php");
}
?>