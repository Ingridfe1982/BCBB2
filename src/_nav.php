<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <a class="navbar-brand" href="index.php">Forum</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      
      <?php
      
      if (empty($_SESSION["nickname"])){
        echo '
        <li class="nav-item active">
          <a class="nav-link" href="login.php">Connexion <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Enregistrement</a>
        </li>';
      } else {
        echo '
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout_script.php">Deconnexion</a>
        </li>
        ';
      }
      ?>
      
    </ul>
    
  </div>
</nav>