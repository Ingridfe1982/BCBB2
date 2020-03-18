<?php
if (empty(session_id())) {session_start();}
include_once("_functions.php");

$db = openDb();
$boardId = $_POST["idBoard"];

// var_dump($_POST);die;
// var_dump($creationDate->format("Y-m-d H:i:s"));die;
$creationDate = new DateTime('now');

$req = $db->prepare('INSERT INTO topics (title, creation_date, id_user, id_board, is_locked) VALUES(:title, :creationDate, :userId, :boardId, :isLocked)');
$req->execute(array(
	'title' => $_POST['title'],
	'creationDate' => $creationDate->format("Y-m-d H:i:s"),
	'userId' => $_SESSION['userId'],
	'boardId' => $boardId,
	'isLocked' => false,
));
// var_dump($db->lastInsertId());die;
$topicId = $db->lastInsertId();

addMessage($db, $_POST, $topicId);

?>