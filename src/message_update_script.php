<?php
if (empty(session_id())) {session_start();}
include_once("_functions.php");

$db = openDb();
$topicId = $_POST["idTopic"];
$messageId = $_POST["idMessage"];
$editionDate = new DateTime("now");

// var_dump($_POST);die;
// var_dump($creationDate->format("Y-m-d H:i:s"));die;

$req = $db->prepare('UPDATE messages SET content = :content, edition_date = :editionDate WHERE id_message = :messageId');
$req->execute(array(
	'content' => $_POST["content"],
    'messageId' => $messageId,
    'editionDate' => $editionDate->format("Y-m-d H:i:s") 
));

header('Location: topic.php?idTopic='.$topicId.'');
?>