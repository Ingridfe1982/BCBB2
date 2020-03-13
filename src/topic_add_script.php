<?php
if (empty(session_id())) {session_start();}
include_once("_functions.php");

$db = openDb();
$boardId = $_POST["idBoard"];

// var_dump($_POST);die;
// var_dump($creationDate->format("Y-m-d H:i:s"));die;

$req = $db->prepare('INSERT INTO topics (title, creation_date, id_user, id_board) VALUES(:title, :creationDate, :userId, :boardId)');
$req->execute(array(
	'title' => $_POST['title'],
	'creationDate' => $creationDate->format("Y-m-d H:i:s"),
	'userId' => $userId,
	'boardId' => $boardId,
));
// var_dump($db->lastInsertId());die;
$topicId = $db->lastInsertId();

addMessage($db, $_POST, $topicId);

header("Location: topic.php");

?>