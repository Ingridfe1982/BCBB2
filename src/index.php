<?php
if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();
$req = $db->prepare('SELECT * FROM boards');
$req->execute(array());
$boards = $req->fetchAll();

// echo '<pre>' . var_export($boards, true) . '</pre>';die;

include('_header.php');
include('_nav.php');
?>
<div class="container">
    <div class="row">
        
        <table class="table">
            <tbody>
                <?php
                foreach($boards as $board) {
                    echo '
                        <tr class="board">
                            <th scope="row" colspan="3">
                                <a href="board.php?idBoard='.$board["id_board"].'&boardName= '.$board["name"].'">    
                                    '.$board["name"].  ' - ' .$board["description"].'
                                </a>
                            </th>
                        </tr>
                    ';

                    $queryTopicsAndLastMessage =
                    'SELECT * 
                        FROM topics t
                        LEFT JOIN messages m
                        ON m.id_topic = t.id_topic
                        WHERE id_board = :idBoard 
                        ORDER BY m.creation_date DESC
                        LIMIT 3
                    ';

                    $reqTopicsAndLastMessage = $db->prepare($queryTopicsAndLastMessage);
                    $reqTopicsAndLastMessage->execute(array(
                        'idBoard'=> $board["id_board"]
                    ));
                    $topicsAndLastMessage = $reqTopicsAndLastMessage->fetchAll();
                    
                    // echo '<pre>' . var_export($topics, true) . '</pre>';die;

                    foreach($topicsAndLastMessage as $topicAndLastMessage) {
                    echo'
                            <tr class="topic">
                                <th scope="row">
                                    <i class="fa fa-file-o mr-3" aria-hidden="true"></i>
                                    <a href="topic.php?idTopic='.$topicAndLastMessage["id_topic"].'">
                                        '.$topicAndLastMessage["title"].'
                                    </a>
                                </th>
                                <td class="text-right topic__edition_date">'.$topicAndLastMessage['edition_date'].'</td>
                            </tr>
                    ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include('_footer.php');
?>

