<?php

  if (isset($_COOKIE['CooUser'])) {
    header("Location: index.php");
  }
  if (isset($_GET['order'])) {
    setcookie('orderWait',TRUE,time()+900,"/");
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
  <link href="./form-reg.css" rel="stylesheet" />
  <div class="form-login-container">
    <div data-role="Header" class="form-login-navbar-container">
      <div class="form-login-navbar">
      <a class="Navbar-Link" href="index.php">Index</a>
        <div class="form-login-links-container">
          <span class="form-login-link Navbar-Link">About</span>
          <a href="form-contact.php" class="Navbar-Link">Contact</a>
        </div>
        <div data-role="BurgerMenu" class="form-login-burger-menu">
          <svg viewBox="0 0 1024 1024" class="form-login-icon">
            <path
              d="M128 256h768v86h-768v-86zM128 554v-84h768v84h-768zM128 768v-86h768v86h-768z"
            ></path>
          </svg>
        </div>
        <div data-role="MobileMenu" class="form-login-mobile-menu">
          <div class="form-login-container1">
          <a class="Navbar-Link" href="index.php">Index</a>
            <div data-role="CloseMobileMenu" class="form-login-close-menu">
              <svg viewBox="0 0 1024 1024" class="form-login-icon02">
                <path
                  d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"
                ></path>
              </svg>
            </div>
          </div>
          <div class="form-login-links-container1">
            <span class="form-login-link4 Navbar-Link">About</span>
            <a href="form-contact.php" class="Navbar-Link">Contact</a>
          </div>
        </div>
      </div>
    </div>
    <div class="form-login-section-separator"></div>
    <div class="form-login-footer-container">
    <h1 style="margin-top:1em;">Pas encore inscrit ? <a style="color:#128076" href="form-reg.php">Cliquez ici</a></h1>
      <div class="form-login-hero">
        <img
          alt="image"
          src="https://img.freepik.com/free-vector/login-concept-illustration_114360-739.jpg?w=2000"
          class="form-login-image"
        />
       
        <form class="form-login-form" action="userLogin.php" method="post">
        <?php
          if (isset($_GET['emty'])) {
            echo "<p style='color:red'>Merci de saisir des informations</p>";
          }
          if (isset($_GET['erreur'])) {
            echo "<p style='color:red'>Merci de réessayer</p>";
          }
        ?>
        
          <div class="form-login-container2">
            <label style="margin-bottom: 5px;">Pseudo :</label>
            <div class="form-login-container3">
              <input type="text" class="input" style="margin-bottom: 1em;" name="username"/>
            </div>
            <label style="margin-bottom: 5px;">Mot de passe :</label>
            <input type="password" class="input" style="margin-bottom: 1em;" name="password"/>
          </div>
          <button class="form-login-button button" type="submit">Button</button>
          <div class="form-login-container4"></div>
        </form>
      </div>
      <div class="form-login-footer">
        <div class="form-login-social-links">
          <svg viewBox="0 0 950.8571428571428 1024" class="form-login-icon04">
            <path
              d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"
            ></path></svg
          ><svg viewBox="0 0 877.7142857142857 1024" class="form-login-icon06">
            <path
              d="M713.143 73.143c90.857 0 164.571 73.714 164.571 164.571v548.571c0 90.857-73.714 164.571-164.571 164.571h-107.429v-340h113.714l17.143-132.571h-130.857v-84.571c0-38.286 10.286-64 65.714-64l69.714-0.571v-118.286c-12-1.714-53.714-5.143-101.714-5.143-101.143 0-170.857 61.714-170.857 174.857v97.714h-114.286v132.571h114.286v340h-304c-90.857 0-164.571-73.714-164.571-164.571v-548.571c0-90.857 73.714-164.571 164.571-164.571h548.571z"
            ></path></svg
          ><svg viewBox="0 0 877.7142857142857 1024" class="form-login-icon08">
            <path
              d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"
            ></path>
          </svg>
        </div>
        <div class="form-login-copyright-container">
          <svg viewBox="0 0 1024 1024" class="form-login-icon10">
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
