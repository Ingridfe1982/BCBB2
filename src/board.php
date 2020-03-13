<?php

if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();

// echo '<pre>' . var_export($boards, true) . '</pre>';die;

include('_header.php');
include('_nav.php');

$idBoard = (isset($_GET["idBoard"]) ? $_GET["idBoard"] : null);
$boardName = (isset($_GET["boardName"]) ? $_GET["boardName"] : null);

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
            <td class="text-right">
                <a href="topic_add.php?idBoard=<?php echo $idBoard; ?>">
                    <button type="button" class="btn btn-success btn-sm">Ajouter un sujet</button>
                </a>
            </td>
        </tr>

        <?php

        foreach($topics as $topic) {
            echo'
                <tr class="topic">
                    <th scope="row">
                        <a href="topic.php?idTopic='.$topic["id_topic"].'">
                            '.$topic["title"].'
                        </a>
                    </th>
                </tr>
            ';
        }
        
        ?>
    </tbody>
</table>
<?php
include("_footer.php");
?>
