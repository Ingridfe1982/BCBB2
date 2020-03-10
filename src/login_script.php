<?php
if (empty(session_id())) {session_start();}
// var_dump($_POST); die;
include_once("_functions.php");
$db = openDb();

$req = $db->prepare('SELECT * FROM users WHERE email = :email');
$req->execute(array(
    'email' => $_POST["email"]
));
// echo '<pre>' . var_export($req->fetch(), true) . '</pre>';die;
$userData = $req->fetch();

$isPasswordCorrect = password_verify($_POST['password'], $userData['password']); 

// ! = contraire de la valeur $isPasswordCorrect (===false)
// if (!$isPasswordCorrect){
//     throw new Exception('Mot de passe incorrect');
// }

if (!$isPasswordCorrect) {
    header("Location: login.php?error=incorrectPassword");
}


$_SESSION["nickname"] = $userData['nickname'];
$_SESSION['email'] = $userData['email'];
$_SESSION["userId"] = $userData['id'] ;
header("Location: index.php");
