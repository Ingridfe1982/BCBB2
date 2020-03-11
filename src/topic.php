<?php
if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();
// echo '<pre>' . var_export($boards, true) . '</pre>';die;

if (isset($_GET["idTopic"])) {
    $idTopic = $_GET["idTopic"];
} else {
    $idTopic = null;
}

include('_header.php');
include('_nav.php');

$req = $db->prepare('SELECT * FROM messages WHERE id_topic = :idTopic');
$req->execute(array(
    'idTopic' => $idTopic
));
$messages = $req->fetchAll();
// echo '<pre>' . var_export($messages, true) . '</pre>';die;

$reqTopic = $db->prepare('SELECT * FROM topics WHERE id = :idTopic');
$reqTopic->execute(array(
    'idTopic' => $idTopic
));
$topic = $reqTopic->fetch();
// echo '<pre>' . var_export($topic, true) . '</pre>';die;

?>

<table class="table">
    <tbody>
        <tr class="topicName" >
            <th scope="row" colspan="2">
                <?php echo $topic["title"];?>
            </th>
        </tr>
        <?php
            foreach($messages as $message) {
                echo'
                    <tr class="message">
                        <th scope="row">
                            avatar
                        </th>
                        <td>
                            '.$message["content"].'
                        </td>
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>
