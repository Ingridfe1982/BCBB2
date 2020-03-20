<?php
if (empty(session_id())) {session_start();}

include_once('_functions.php');
ifUserLogOffRedirect();

$db = openDb();

// echo '<pre>' . var_export($boards, true) . '</pre>';die;

$messageId = (isset($_GET["messageId"]) ? $_GET["messageId"] : null);
$topicId = (isset($_GET["topicId"]) ? $_GET["topicId"] : null);

$req = $db->prepare('SELECT * FROM messages WHERE id_message = :idMessage');
$req->execute(array(
    'idMessage' => $messageId
));
$message = $req->fetch();

checkUserAccess('messages', $messageId);

include('_header.php');
include('_nav.php');

// var_dump($message['id_user']);die;
?>

<div class="container">
    <div class="row">
        <div class="col-12">
        <form action="message_update_script.php" method="post">
            <div class="form-group">
                <label for="content">Message</label>
                <textarea name="content" class="form-control emoji-wysiwyg-editor" id="content" rows="3" data-emojiable="true" data-emoji-input="unicode"><?php echo $message["content"];?></textarea>
            </div>
            <input type="hidden" name="idMessage" value="<?php echo $messageId; ?>"> 
            <input type="hidden" name="idTopic" value="<?php echo $topicId; ?>"> 
            <div class="text-center">
                <button type="submit"  class="btn btn-primary mb-2">Modifier</button>
            </div>
            
        </form>
        </div>
    </div>
</div>

<?php
include("_footer.php");
?>
