<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>GetALogo</title>
    <meta property="og:title" content="Portfolio Page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
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
    <div>
      <link href="./home.css" rel="stylesheet" />

      <div class="home-container">
        <div data-role="Header" class="home-navbar-container">
          <div class="home-navbar">
            <a class="Navbar-Link" href="index.php">Index</a>
            <div class="home-links-container">
            <a  style="margin-right:1em" href="galerie.php" class="Navbar-Link">Galerie</a>
              <a href="form-contact.php" class="Navbar-Link">Contact</a>
              <?php
                if (isset($_COOKIE["CooUser"])) {
                  echo "<a style='margin-left:1em;' class='Navbar-Link' href='userManage/seeCommande.php'>Mes commandes</a>";
                  echo "<a style='margin-left:1em;' class='Navbar-Link' href='logout.php'>Déconnexion</a>";

                }else {
                  echo "<a style='margin-left:1em;' class='Navbar-Link' href='form-login.php'>Login</a>";
                }
              ?>
              
            </div>
            <div data-role="BurgerMenu" class="home-burger-menu">
              <svg viewBox="0 0 1024 1024" class="home-icon">
                <path
                  d="M128 256h768v86h-768v-86zM128 554v-84h768v84h-768zM128 768v-86h768v86h-768z"
                ></path>
              </svg>
            </div>
            <div data-role="MobileMenu" class="home-mobile-menu">
              <div class="home-container1">
                <span class="Card-Heading home-heading1">Logo</span>
                <div data-role="CloseMobileMenu" class="home-close-menu">
                  <svg viewBox="0 0 1024 1024" class="home-icon02">
                    <path
                      d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"
                    ></path>
                  </svg>
                </div>
              </div>
              <div class="home-links-container1">
                <span class="home-link4 Navbar-Link">About</span>
                <a href="form-contact.php" class="Navbar-Link">Contact</a>
                <?php
                if (isset($_COOKIE["CooUser"])) {
                  echo "<a style='margin-left:1em;' class='Navbar-Link' href='userManage/seeCommande.php'>Mes commandes</a>";
                  echo "<a style='margin-left:1em;' class='Navbar-Link' href='logout.php'>Déconnexion</a>";

                }else {
                  echo "<a style='margin-left:1em;' class='Navbar-Link' href='form-login.php'>Login</a>";
                }
              ?>
              </div>
            </div>
          </div>
        </div>
        <div class="home-section-separator"></div>
        <div class="home-section-separator1"></div>
        <div class="home-container2">
          <div class="home-hero">
            <div class="home-hero-text-container">
              <h1 class="home-heading2">
                Bienvenue sur notre site web de création de logos personnalisés
                ! Nous sommes fiers de vous offrir une expérience de conception
                de logo unique et professionnelle.
              </h1>
              <span class="home-text">
                Notre équipe de designers expérimentés travaillera avec vous
                pour créer le logo parfait pour votre entreprise ou marque. Nous
                comprenons l'importance d'avoir un logo qui reflète votre image
                de marque, c'est pourquoi nous prenons le temps de comprendre
                vos besoins et de créer quelque chose qui vous ressemble.
              </span>
              <div class="home-cta-btn-container">
                <a href="form-name.php" class="home-cta-btn Anchor button">
                  <span class="home-text1">Commencer !</span>
                </a>
              </div>
            </div>
            <img
              alt="image"
              src="../asset/SeekPng.com_genji-sword-png_1714017.png"
              class="home-image"
            />
          </div>
        </div>
        <div class="home-section-separator2"></div>
        <div class="home-footer-container">
          <div class="home-footer">
            <div class="home-copyright-container">
              <svg viewBox="0 0 1024 1024" class="home-icon10">
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
