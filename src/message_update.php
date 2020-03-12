<?php
if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();

// echo '<pre>' . var_export($boards, true) . '</pre>';die;

include('_header.php');
include('_nav.php');

// Verifie que le paramètre passé par l'url (la valeur) est bien définie
if (isset($_GET["messageId"])) {
    $messageId = $_GET["messageId"];
} else {
    $messageId = null;
}
if (isset($_GET["topicId"])) {
    $topicId = $_GET["topicId"];
} else {
    $topicId = null;
}

$req = $db->prepare('SELECT * FROM messages WHERE id_message = :idMessage');
$req->execute(array(
    'idMessage' => $messageId
));
$message = $req->fetch();

// var_dump($message);die;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <form action="message_update_script.php" method="post">
            <div class="form-group">
                <label for="content">Message</label>
                <textarea name="content" class="form-control" id="content" rows="3"><?php echo $message["content"];?></textarea>
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
