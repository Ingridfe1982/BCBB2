<?php
if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();

// echo '<pre>' . var_export($boards, true) . '</pre>';die;

include('_header.php');
include('_nav.php');

// Verifie que le paramètre passé par l'url (la valeur) est bien définie
if (isset($_GET["idBoard"])) {
    $idBoard = $_GET["idBoard"];
} else {
    $idBoard = null;
}

if (isset($_GET["boardName"])) {
    $boardName = $_GET["boardName"];
} else {
    $boardName= null;
}

$req = $db->prepare('SELECT * FROM topics WHERE id_board = :idBoard');
$req->execute(array(
    'idBoard' => $idBoard
));
$topics = $req->fetchAll();
?>

<table class="table">
    <tbody>
        <tr class="board">
            <th scope="row"><?php echo $boardName; ?></th>
        </tr>
        <?php
            foreach($topics as $topic) {
                echo'
                    <tr class="topic">
                        <th scope="row">
                            <a href="topic.php?idTopic='.$topic["id"].'">
                                '.$topic["title"].'
                            </a>
                        </th>
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>
