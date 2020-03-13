<?php
if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();
// echo '<pre>' . var_export($boards, true) . '</pre>';die;

$idTopic = (isset($_GET["idTopic"]) ? $_GET["idTopic"] : null);

include('_header.php');
include('_nav.php');

$reqTopic = $db->prepare('SELECT * FROM topics WHERE id_topic = :idTopic');
$reqTopic->execute(array(
    'idTopic' => $idTopic
));
$topic = $reqTopic->fetch();
// echo '<pre>' . var_export($topic, true) . '</pre>';die;

$queryMessagesAndUser = 
    'SELECT * 
     FROM messages m
     LEFT JOIN users u
     ON m.id_user = u.id_user
     WHERE id_topic = :idTopic
    ';

$req = $db->prepare($queryMessagesAndUser);
$req->execute(array(
    'idTopic' => $idTopic
));
$messagesAndUser = $req->fetchAll();
// echo '<pre>' . var_export($messagesAndUser, true) . '</pre>';die;

// var_dump($messagesAndUser);die;
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
            foreach($messagesAndUser as $messageAndUser) {
                echo'
                    <tr class="message">
                        <th scope="row">
                            <img src="https://www.gravatar.com/avatar/'.$messageAndUser['avatar'].' alt="">
                        </th>
                        <td>
                            '.$messageAndUser["content"].'
                        </td>
                        <td>
                            <a href="message_update.php?messageId='.$messageAndUser["id_message"].'&topicId='.$idTopic.'">
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
