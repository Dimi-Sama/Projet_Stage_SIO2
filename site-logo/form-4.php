<?php

if (!isset($_COOKIE['session'])) {
  header("Location: index.php");
}
require "lib/dbConnect.php";
$bd = new DbConnect();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Form-4</title>
    <meta property="og:title" content="Form-2 - Portfolio Page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style>
input[type="checkbox"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  color: #fff;
  text-align: center;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: black;
  border-width: 5px;
  }

:checked + label:before {
  content: "✓";
  background-color: black;
  transform: scale(1);
}
:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Arial;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.55;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
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
  <body>
  <?php require "lib/navbar.php"; 
  
  $conn = $bd->connect();

$sql = "SELECT limStyle FROM limite";
$req = $conn->prepare($sql);
$req->execute();
$limite = $req->fetch(PDO::FETCH_ASSOC);
$limiteStyle = $limite['limStyle'];
?>
        <div class="form2-section-separator"></div>
        <div class="form2-section-separator1"></div>
        <h1 class="form2-text">Choix de styles (<?php echo $limiteStyle ?> max)</h1>
        <?php
        if(isset($_GET['false'])){
          echo '<p style="color:red">Merci de choisir une option</p>';
        }
        ?>
        <div class="form2-container02">
          <div class="form2-container03">
            <form class="form2-form" action="verifForm4.php" method="post">
              <div class="form2-container04">
              <?php 
              $i = 0;
                  

                  $conn = $bd->connect();

                  $sql = "SELECT * FROM style";
                  $result = $conn->prepare($sql);			
                  $result->execute();          
                  foreach ($result as $couleur) {
                    $i++;
                    

                   echo "<div class='container'>
                    <input type='checkbox' value=". $couleur['id'] . " id='logo-$i' class='input' name='style[]'/>
                    <label for='logo-$i'>
                    <img src=" . '../asset/imgStyle/'. $couleur['img'] ." />
                  </label>
                  </div>";

                  }

                  ?>
              </div>
              <button type="submit" class="form2-button button">Button</button>
            </form>
            <script>
              var limit = <?php echo $limiteStyle ?>;
              $('input.input').on('click', function (evt) {
              if ($('.input:checked').length > limit) {
                this.checked = false;
              }
              });
            </script>
          </div>
        </div>
        <div class="form2-section-separator2"></div>
        <div class="form2-footer-container">
          <div class="form2-footer">
            <div class="form2-copyright-container">
              <svg viewBox="0 0 1024 1024" class="form2-icon10">
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
    <script src="https://unpkg.com/@teleporthq/teleport-custom-scripts"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  </body>
</html>
