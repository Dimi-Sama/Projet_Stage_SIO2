<?php

if ( !isset($_COOKIE['CooName']) || !isset($_COOKIE['CooSecteur']) || !isset($_COOKIE['CooStyLogo']) || !isset($_COOKIE['CooStyles']) || !isset($_COOKIE['CooCouleur']) || !isset($_COOKIE['CooForfait']) || !isset($_COOKIE['session'])) {
  header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Form-X</title>
    <meta property="og:title" content="Form-2 - Portfolio Page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
<link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>
<div>
  <link href="./form-val.css" rel="stylesheet" />
  <div class="form-val-container">
    <div data-role="Header" class="form-val-navbar-container">
      <div class="form-val-navbar">
      <a class="Navbar-Link" href="index.php">Index</a>
        <div class="form-val-links-container">
          <span class="form-val-link Navbar-Link">About</span>
          <a href="form-contact.php" class="Navbar-Link">Contact</a>
        </div>
        <div data-role="BurgerMenu" class="form-val-burger-menu">
          <svg viewBox="0 0 1024 1024" class="form-val-icon">
            <path
              d="M128 256h768v86h-768v-86zM128 554v-84h768v84h-768zM128 768v-86h768v86h-768z"
            ></path>
          </svg>
        </div>
        <div data-role="MobileMenu" class="form-val-mobile-menu">
          <div class="form-val-container1">
          <a class="Navbar-Link" href="index.php">Index</a>
            <div data-role="CloseMobileMenu" class="form-val-close-menu">
              <svg viewBox="0 0 1024 1024" class="form-val-icon02">
                <path
                  d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"
                ></path>
              </svg>
            </div>
          </div>
          <div class="form-val-links-container1">
            <span class="form-val-link4 Navbar-Link">About</span>
            <a href="form-contact.php" class="Navbar-Link">Contact</a>
          </div>
        </div>
      </div>
    </div>
    <div class="form-val-section-separator"></div>
    <div class="form-val-footer-container">
      <div class="form-val-hero">
        <img
          alt="image"
          src="https://images.unsplash.com/photo-1529859503572-5b9d1e68e952?ixid=Mnw5MTMyMXwwfDF8c2VhcmNofDN8fG1pbmltYWxpc20lMjBjb3VjaHxlbnwwfHx8fDE2MjYxODI1OTE&amp;ixlib=rb-1.2.1&amp;w=1500"
          class="form-val-image"
        />
        <div class="form-val-container2">
          <h1 class="form-val-text">Verification des informations</h1>
          <style>
            table,
              td {
                border: 1px solid #333;
                  }

              thead,
              tfoot {
                  background-color: #333;
                  color: #fff;
              }

              #Simg img {
              height: 70px;
              width: 70px;
              aspect-ratio: 1 / 1;
              object-fit: cover;
              transition-duration: 0.2s;
              transform-origin: 50% 50%;
            }
            #Simg {
              display: flex;
              flex-direction: row;
              justify-content:space-around;
              flex-wrap: wrap;
            }
          </style>
         <table>
          <?php require "lib/dbConnect.php"; $bd = new DbConnect(); $conn = $bd->connect(); ?>
            <thead>
              
                <tr>
                    <th colspan="2">Résumé de la commande</th>
                </tr>
            </thead>
            <tbody>
                 <tr>
                    <td>Nom sur le logo</td>
                    <td>
                      <?php 
                        echo $_COOKIE['CooName'];
                      ?>
                  </td>
                </tr>
                <tr>
                    <td>Secteur d'activité</td>
                    <td>
                      <?php 
                      $id = $_COOKIE['CooSecteur'];
                        $sql = "SELECT libelle FROM secteuract WHERE id= :id";
                        $req = $conn->prepare($sql);
                        $req->bindParam(':id',$id);
                        $req->execute();
                        $secteur = $req->fetch(PDO::FETCH_ASSOC);
                        echo $secteur['libelle'];
                      ?>
                  </td>
                </tr>
                <tr>
                    <td>Style de logo</td>
                    <td style="display:flex; justify-content: space-around;  align-items: center;">
                    <?php 
                      $id = $_COOKIE['CooStyLogo'];
                        $sql = "SELECT libelle, img FROM stylelogo WHERE id= :id";
                        $req = $conn->prepare($sql);
                        $req->bindParam(':id',$id);
                        $req->execute();
                        $logo = $req->fetch(PDO::FETCH_ASSOC);
                        echo "<p>" . $logo['libelle'] ."</p>
                        <img style='height: 120px; border: 2px solid #333' src=" . '../asset/imgLogo/'. $logo['img'] . ">"
                      ?>
                  </td>
                </tr>
                <tr>
                  <td>Logo fourni</td>
                  <td>
                    <?php if (isset($_COOKIE['CooLogoUser'])) {
                     echo " <img  style='height: 120px;' src='../asset/imgTemp/" .$_COOKIE['CooLogoUser'] ."' alt=''></td>";
                    }else {
                      echo "Pas d'image fourni";
                    } 
                    ?> 
                   
                </tr>
                <tr>
                    <td>Couleur(s)</td>
                    <td>
                    <?php 
                      $listCouleur = explode("/",$_COOKIE["CooCouleur"]);
                      foreach($listCouleur as $couleur){
                        if($couleur == "" ){
                          
                        }elseif ($couleur == "on") {
                          echo "<p style='color: ".$_COOKIE['CooCustomCo'].";'> Couleur personalisé : " . $_COOKIE['CooCustomCo'] ."</p>";
                        }else {
                          $sql = "SELECT libelle FROM couleur WHERE id= :id";
                          $req = $conn->prepare($sql);
                          $req->bindParam(':id',$couleur);
                          $req->execute();
                          $logo = $req->fetch(PDO::FETCH_ASSOC);
                        echo "<p>" . $logo['libelle'] ."</p>";
                        }
                        
                      }
                      ?>
                    </td>
                </tr>
                <tr>
                    <td>Style(s)</td>
                    <td id = "Simg">
                    <?php 
                      $listStyle = explode("/",$_COOKIE["CooStyles"]);
                      foreach($listStyle as $style){
                        if($style == "" ){
                          
                        }else {
                          $sql = "SELECT img FROM style WHERE id= :id";
                          $req = $conn->prepare($sql);
                          $req->bindParam(':id',$style);
                          $req->execute();
                          $logo = $req->fetch(PDO::FETCH_ASSOC);
                        echo "<img src=" . '../asset/imgStyle/'. $logo['img'] ." />";
                        }
                        
                      }
                      ?>
                    </td>
                </tr>
                <tr>
                    <td>Forfait</td>
                    <td>
                      <?php 
                      $id = $_COOKIE['CooForfait'];
                        $sql = "SELECT libelle FROM forfait WHERE id= :id";
                        $req = $conn->prepare($sql);
                        $req->bindParam(':id',$id);
                        $req->execute();
                        $forfait = $req->fetch(PDO::FETCH_ASSOC);
                        echo $forfait['libelle'];
                      ?>
                  </td>
                </tr>
                <tr>
                    <td>Prix</td>
                    <td>
                      <?php 
                      $id = $_COOKIE['CooForfait'];
                        $sql = "SELECT prix FROM forfait WHERE id= :id";
                        $req = $conn->prepare($sql);
                        $req->bindParam(':id',$id);
                        $req->execute();
                        $forfait = $req->fetch(PDO::FETCH_ASSOC);
                        echo $forfait['prix'] . " €";
                      ?>
                  </td>
                </tr>
            </tbody>
        </table>
          <?php

          if(isset($_COOKIE['CooUser'])){
            echo "<div class='form-val-btn-group'>
            <a href='pay.php' class='form-val-button button'>Valider</a>
          </div>";
          }else {
            echo "<div class='form-val-btn-group'>
            <h3 style='margin-right: 15px'>Veuillez vous connecter pour poursuivre</h3>
            <a href='form-login.php?order=TRUE' class='form-val-button button'>Connexion</a>
          </div>";
          }
          ?>

        </div>
      </div>
      <div class="form-val-footer">
        <div class="form-val-social-links">
          <svg viewBox="0 0 950.8571428571428 1024" class="form-val-icon04">
            <path
              d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"
            ></path></svg
          ><svg viewBox="0 0 877.7142857142857 1024" class="form-val-icon06">
            <path
              d="M713.143 73.143c90.857 0 164.571 73.714 164.571 164.571v548.571c0 90.857-73.714 164.571-164.571 164.571h-107.429v-340h113.714l17.143-132.571h-130.857v-84.571c0-38.286 10.286-64 65.714-64l69.714-0.571v-118.286c-12-1.714-53.714-5.143-101.714-5.143-101.143 0-170.857 61.714-170.857 174.857v97.714h-114.286v132.571h114.286v340h-304c-90.857 0-164.571-73.714-164.571-164.571v-548.571c0-90.857 73.714-164.571 164.571-164.571h548.571z"
            ></path></svg
          ><svg viewBox="0 0 877.7142857142857 1024" class="form-val-icon08">
            <path
              d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"
            ></path>
          </svg>
        </div>
        <div class="form-val-copyright-container">
          <svg viewBox="0 0 1024 1024" class="form-val-icon10">
            <path
              d="M512 854q140 0 241-101t101-241-101-241-241-101-241 101-101 241 101 241 241 101zM512 86q176 0 301 125t125 301-125 301-301 125-301-125-125-301 125-301 301-125zM506 390q-80 0-80 116v12q0 116 80 116 30 0 50-17t20-43h76q0 50-44 88-42 36-102 36-80 0-122-48t-42-132v-12q0-82 40-128 48-54 124-54 66 0 104 38 42 42 42 98h-76q0-14-6-26-10-20-14-24-20-20-50-20z"
            ></path>
          </svg>
          <span>
            <span class="Anchor">Copyright, 2023</span>
            <br />
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
