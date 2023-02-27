<?php


if ( !isset($_COOKIE['CooName']) || !isset($_COOKIE['CooSecteur']) || !isset($_COOKIE['CooStyLogo']) || !isset($_COOKIE['CooStyles']) || !isset($_COOKIE['CooCouleur']) || !isset($_COOKIE['CooForfait']) || !isset($_COOKIE['session'])) {
    header("Location: index.php");
  }
  
  if(!isset($_COOKIE['CooUser'])){
    header("Location: form-login.php");
  }else{
    $idUser = $_COOKIE['CooUser'];
    $nomLogo = $_COOKIE['CooName'];
    $secteur = $_COOKIE['CooSecteur'];
    $Stylelogo = $_COOKIE['CooStyLogo'];
    if (isset($_COOKIE['CooLogoUser'])) { 
      $logoUser = $_COOKIE['CooLogoUser'];
    }else {
      $logoUser = NULL;
    }
    $Style = $_COOKIE['CooStyles'];
    $couleur = $_COOKIE['CooCouleur'];
    if (isset($_COOKIE['CooCustomCo'])) {
      $custom = $_COOKIE['CooCustomCo'];
    }else {
      $custom = NULL;
    }
    $forfait = $_COOKIE['CooForfait'];

    require "lib/dbConnect.php";
    $bd = new DbConnect();
    $conn = $bd->connect();

    $sql = "INSERT INTO commandes (numero,idUser,nomLogo,logoUser,idSecteur,idStyleLogo,idCouleur,couleurCustom,idStyle,idForfait,idEtat,logoFinal) 
    VALUES (NULL,:idUser,:nomLogo,:logoUser,:idSecteur,:idStyleLogo,:idCouleur,:custom,:idStyle,:idForfait,1,'')";
        // Pour éviter les injections SQL
        $result = $conn->prepare($sql);			
        $result->bindParam(':idUser',$idUser);
        $result->bindParam(':nomLogo', $nomLogo);
        $result->bindParam(':logoUser', $logoUser);
        $result->bindParam(':idSecteur', $secteur);
        $result->bindParam(':idStyleLogo', $Stylelogo);
        $result->bindParam(':idCouleur', $couleur);
        $result->bindParam(':custom', $custom);
        $result->bindParam(':idStyle', $Style);	
        $result->bindParam(':idForfait', $forfait);
        if ($result->execute()) {

          $filePath = '../asset/imgTemp/'.$logoUser;
          $destinationFilePath = '../asset/imgLogoUser/'.$logoUser;
          rename($filePath, $destinationFilePath);

          $sql = "UPDATE styleLogo set nbUtilisation = nbUtilisation +1 WHERE id = :id";
              // Pour éviter les injections SQL
              $result = $conn->prepare($sql);			
              $result->bindParam(':id', $Stylelogo);
              $result->execute();

              $sql = "UPDATE forfait set nbUtilisation = nbUtilisation +1 WHERE id = :id";
              // Pour éviter les injections SQL
              $result = $conn->prepare($sql);			
              $result->bindParam(':id', $forfait);
              $result->execute();
          
              $listStyle = explode("/",$_COOKIE["CooStyles"]);
                      foreach($listStyle as $style){
                        if($style == "" ){
                          
                        }else {
                          $sql = "UPDATE style set nbUtilisation = nbUtilisation +1 WHERE id = :id";
                          $req = $conn->prepare($sql);
                          $req->bindParam(':id',$style);
                          $req->execute();
                        }
                        
                      }

         unset($_COOKIE['CooName']); 
         setcookie("CooName","", time()-(60*60*24*7),"/");

         unset($_COOKIE['CooSecteur']); 
         setcookie("CooSecteur","", time()-(60*60*24*7),"/");

         unset($_COOKIE['CooStyLogo']); 
         setcookie("CooStyLogo","", time()-(60*60*24*7),"/");

         unset($_COOKIE['CooLogoUser']); 
         setcookie("CooLogoUser","", time()-(60*60*24*7),"/");

         unset($_COOKIE['CooStyle']); 
         setcookie("CooStyle","", time()-(60*60*24*7),"/");

         unset($_COOKIE['CooCouleur']); 
         setcookie("CooCouleur","", time()-(60*60*24*7),"/");

         unset($_COOKIE['CooCustomCo']); 
         setcookie("CooCustomCo","", time()-(60*60*24*7),"/");

         unset($_COOKIE['CooForfait']); 
         setcookie("CooFortfait","", time()-(60*60*24*7),"/");


            header("Location: mail.php");
        }else {
            header("Location: form-req.php?erreur=TRUE");
        }

    }	

?>