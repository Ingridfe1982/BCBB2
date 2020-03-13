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
<div class="container">
    <div class="row">
        <table class="table">
            <tbody>
                <tr class="topicName" >
                    <th scope="row" colspan="2">
                        <?php echo $topic["title"];?>
                    </th>
                    <td class="text-right">
                        <a href="message_add.php?idTopic=<?php echo $idTopic; ?>">
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php
                    foreach($messagesAndUser as $messageAndUser) { ?>
                    
                        <tr class="message">
                            <th scope="row">
                                <img src="https://www.gravatar.com/avatar/<?php echo $messageAndUser["avatar"]; ?>' alt="">
                            </th>
                            <td>
                                <?php echo $messageAndUser["edition_date"]; ?>
                                <hr>
                                <?php echo $messageAndUser["content"]; ?>
                                <hr>
                                <?php echo $messageAndUser["signature"]; ?>
                            </td>
                            <td class="text-right">
                                <?php if (!empty($_SESSION["userId"]) && $_SESSION["userId"] == $messageAndUser['id_user']) { ?>
                                    <a href="message_update.php?messageId=<?php echo $messageAndUser["id_message"]; ?>&topicId=<?php echo $idTopic; ?>">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="message_delete_script.php?messageId=<?php echo $messageAndUser["id_message"]; ?>&topicId=<?php echo $idTopic; ?>">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php    
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include("_footer.php");
?>
