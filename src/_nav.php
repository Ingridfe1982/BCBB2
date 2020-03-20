<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <a class="navbar-brand" href="index.php">Forum</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown text-center">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
              if ($_SESSION["photo"] != null) { ?>

                <img src="/img/upload/<?php echo $_SESSION["photo"]?>" alt="" class="rounded-circle" width="35px">

              <?php
              } else { ?>

                <img src="https://www.gravatar.com/avatar/<?php echo $_SESSION["avatar"]?>" alt="" class="rounded-circle" width="35px" >
              
              <?php
              }
              ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php 
                  if (!empty($_SESSION["nickname"])) { ?>
                      
                      <a class="dropdown-item" href="profile.php">Profil</a>
                      <a class="dropdown-item" href="logout_script.php">Deconnexion</a>

                  <?php } else { ?>
                    
                      <a class="dropdown-item" href="login.php">Connexion</a>
                      <a class="dropdown-item" href="register.php">Créer un compte</a>

                  <?php }
              ?>
          </div>
      </li>
    </ul>
  </div>
</nav>