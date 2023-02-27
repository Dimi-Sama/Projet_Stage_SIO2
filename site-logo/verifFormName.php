<?php
$sec = hash('sha256',$_SERVER['REMOTE_ADDR']);

if(!isset($_POST['nameLogo'])|| $_POST['nameLogo'] ==""){
    header("Location: form-name.php?false=TRUE");
}else{
    if ($_FILES['image']['size'] > 0) {
        $repImg = '../asset/imgTemp/';
        $imgName = $_FILES["image"]["name"];
        move_uploaded_file($_FILES['image']['tmp_name'], $repImg . $imgName);
        setcookie("CooLogoUser",$imgName,time()+900,"/");
    }
    $nameLogo = $_POST['nameLogo'];
    setcookie("session",$sec,time()+900,"/");
    setcookie("CooName",$nameLogo,time()+900,"/");
header("Location: form-1.php");
}

?>