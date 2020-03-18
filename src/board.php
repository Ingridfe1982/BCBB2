<?php

if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();

// echo '<pre>' . var_export($boards, true) . '</pre>';die;

$idBoard = (isset($_GET["idBoard"]) ? $_GET["idBoard"] : null);

$reqBoard = $db->prepare('SELECT * FROM boards WHERE id_board = :idBoard');
$reqBoard->execute(array(
    'idBoard' => $idBoard
));
$board = $reqBoard->fetch();

ifBoardIsSecretAndWrongSecretRedirect($board, $_GET);

$reqTopics = $db->prepare('SELECT * FROM topics WHERE id_board = :idBoard');
$reqTopics->execute(array(
    'idBoard' => $idBoard
));
$topics = $reqTopics->fetchAll();

include('_header.php');
include('_nav.php');

?>
<div class="container">
    <div class="row">
        <table class="table">
            <tbody>
                <tr class="board">
                    <th scope="row"><?php echo $board['name']; ?></th>
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
    </div>
</div>
<?php
include("_footer.php");
?>
