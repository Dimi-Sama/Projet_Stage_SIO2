<?php
unset($_COOKIE['CooUser']); 
setcookie("CooUser","", time()-(60*60*24*7),"/");
header("Location: index.php");
?>