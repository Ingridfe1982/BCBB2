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
<table class="table">
    <tbody>
        <?php
        foreach($boards as $board) {
            echo '
                <tr class="board">
                    <th scope="row">
                        <a href="board.php?idBoard='.$board["id_board"].'&boardName= '.$board["name"].'">    
                            '.$board["name"].  ' - ' .$board["description"].'
                        </a>
                    </th>
                </tr>
            ';

            $queryTopics =
              'SELECT * 
                FROM topics t
                LEFT JOIN messages m
                ON m.id_topic = t.id_topic
                WHERE id_board = :idBoard 
                ORDER BY m.creation_date DESC
                LIMIT 3
              ';


            $reqTopics = $db->prepare($queryTopics);
            $reqTopics->execute(array(
                'idBoard'=> $board["id_board"]
            ));
            $topics = $reqTopics->fetchAll();
            
            // echo '<pre>' . var_export($topics, true) . '</pre>';die;

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
        }
        ?>
    </tbody>
</table>

<?php
include('_footer.php');
?>

