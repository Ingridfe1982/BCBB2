<?php
include_once("_functions.php");

$db = openDb();

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// var_dump($password);die;
$avatar = md5(strtolower(trim(htmlspecialchars($_POST['email']))));

$req = $db->prepare('INSERT INTO users(email, password, nickname, avatar) VALUES(:email, :password, :nickname, :avatar)');
$req->execute(array(
	'email' => $_POST['email'],
	'password' => $password,
	'nickname' => $_POST['nickname'],
	'avatar' => $avatar
));

?>