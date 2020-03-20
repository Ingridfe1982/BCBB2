<?php
if (empty(session_id())) {session_start();}

include_once("_functions.php");
$db = openDb();

// var_dump($_POST);die;
$req = $db->prepare('UPDATE users SET nickname = :nickname, password = :password, signature = :signature WHERE id_user = :userId');
$req->execute(array(
	'nickname' => $_POST["nickname"],
	'password' => password_hash($_POST["password"], PASSWORD_DEFAULT),
    'signature' => $_POST["signature"],
    'userId' => $_SESSION["userId"]
));
if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
    $tailleMax = 20971520000;
    $extensionsValides = array('jpg', 'jpeg','gif','png');
        if ($_FILES['avatar']['size'] <= $tailleMax){ 
            
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));
            if (in_array($extensionUpload, $extensionsValides)) {
                $cheminUpload = "img/upload/".$_SESSION['userId'].'.'.$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$cheminUpload);
                

                if ($resultat){
                    // var_dump($_SESSION['userId']);
                    // var_dump($extensionUpload);die;
                    $updateavatar = $db->prepare('UPDATE users SET photo = :photo WHERE id_user = :userId');
                    $updateavatar->execute(array(
                        'photo' => $_SESSION['userId'].".".$extensionUpload,
                        'userId' => $_SESSION['userId']
                    ));
                    header("Location: profile.php");
                }
                else {
                    $msg = "Erreur";
                }
            }
            else {
                $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
            } 
        }
        else {
            $msg = "Votre photo ne peut pas dépasser 2Mo";
        }
    }
var_dump($msg);


// header("Location: profile.php");
