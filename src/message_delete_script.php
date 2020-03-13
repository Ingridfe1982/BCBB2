<?php
if (empty(session_id())) {session_start();}

include_once('_functions.php');
ifUserLogOffRedirect();

$messageId = (isset($_GET["messageId"]) ? $_GET["messageId"] : null);
$topicId = (isset($_GET["topicId"]) ? $_GET["topicId"] : null);

checkUserAccess('messages', $messageId);

$db = openDb();

// var_dump($_POST);die;
// var_dump($creationDate->format("Y-m-d H:i:s"));die;

$req = $db->prepare('DELETE FROM messages WHERE id_message = :messageId');
$req->execute(array(
    'messageId' => $messageId,
));

header('Location: topic.php?idTopic='.$topicId.'');

?>