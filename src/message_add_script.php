<?php
if (empty(session_id())) {session_start();}
include_once("_functions.php");

$db = openDb();
$topicId = $_POST["idTopic"];

// var_dump($_POST);die;
// var_dump($creationDate->format("Y-m-d H:i:s"));die;

addMessage($db, $_POST, $topicId);

?>