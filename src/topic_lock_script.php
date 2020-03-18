<?php
if (empty(session_id())) {session_start();}
include_once("_functions.php");

$idTopic = (isset($_GET["idTopic"]) ? $_GET["idTopic"] : null);

checkUserAccess('topics', $idTopic);

$db = openDb();

$req = $db->prepare('UPDATE topics SET is_locked = :isLocked WHERE id_topic = :topicId');
$req->execute(array(
	'isLocked' => true,
    'topicId' => $idTopic
));

header('Location: topic.php?idTopic='.$idTopic.'&success=topicLocked');

?>