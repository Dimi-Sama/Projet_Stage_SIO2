<div>
      <link href="./form.css" rel="stylesheet" />

      <div class="form2-container">
        <div data-role="Header" class="form2-navbar-container">
          <div class="form2-navbar">
          <a class="Navbar-Link" href="index.php">Index</a>
            <div class="form2-links-container">
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
            <div data-role="BurgerMenu" class="form2-burger-menu">
              <svg viewBox="0 0 1024 1024" class="form2-icon">
                <path
                  d="M128 256h768v86h-768v-86zM128 554v-84h768v84h-768zM128 768v-86h768v86h-768z"
                ></path>
              </svg>
            </div>
            <div data-role="MobileMenu" class="form2-mobile-menu">
              <div class="form2-container01">
                <span class="Card-Heading form2-heading1">Logo</span>
                <div data-role="CloseMobileMenu" class="form2-close-menu">
                  <svg viewBox="0 0 1024 1024" class="form2-icon02">
                    <path
                      d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"
                    ></path>
                  </svg>
                </div>
              </div>
              <div class="form2-links-container1">
                <span class="form2-link4 Navbar-Link">About</span>
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