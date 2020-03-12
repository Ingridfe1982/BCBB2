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

$reqTopic = $db->prepare('SELECT * FROM topics WHERE id_topic = :idTopic');
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
            <td class="text-right">
                <a href="message_add.php?idTopic=<?php echo $idTopic; ?>">
                    <button type="button" class="btn btn-success btn-sm" >Ajouter un message</button>
                </a>
            </td>
        </tr>
        <?php
            foreach($messages as $message) {
                echo'
                    <tr class="message">
                        <th scope="row">
                            <img src="https://www.gravatar.com/avatar/ alt="">
                        </th>
                        <td>
                            '.$message["content"].'
                        </td>
                        <td>
                            <a href="message_update.php?messageId='.$message["id_message"].'&topicId='.$idTopic.'">
                                <button type="button" class="btn btn-warning btn-sm" >Modifier message</button>
                            </a>
                        </td>
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>
<?php
include("_footer.php");
?>
