<?php
include('_header.php');
include('_nav.php');

if (isset($_GET["error"])) {

    switch ($_GET["error"]) {
        case 'incorrectPassword':
            $error = "Mot de passe incorrect";
            break;
        case 'userLogOff':
            $error = "Vous devez vous connecter pour pouvoir participer à la discussion";
            break;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-12">

        <?php
            if (!empty($error)) {
                echo ' <div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
        ?>

        <form action="login_script.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Connexion</button>
                <a href="register.php">
                    <div class="btn btn-primary">Créer un compte</div>
                </a>
            </div>
        </form>
        </div>
    </div>
</div>

<?php
include('_footer.php');
?>