<?php
if (empty(session_id())) {session_start();}

include_once("_functions.php");
$db = openDb();

// var_dump($_POST);die;
$req = $db->prepare('UPDATE users SET nickname = :nickname, password = :password, signature = :signature WHERE id = :userId');
$req->execute(array(
	'nickname' => $_POST["nickname"],
	'password' => password_hash($_POST["password"], PASSWORD_DEFAULT),
    'signature' => $_POST["signature"],
    'userId' => $_SESSION["userId"]
    ));

header("Location: profile.php");
    