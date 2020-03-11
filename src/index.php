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
                        <a href="board.php?idBoard='.$board["id"].'&boardName= '.$board["name"].'">    
                            '.$board["name"].  ' - ' .$board["description"].'
                        </a>
                    </th>
                </tr>
            ';

            $queryTopics =
                'SELECT * 
                FROM topics t
                --  LEFT JOIN messages m
                --  ON m.id_topic = t.id
                RIGHT JOIN messages m
                ON t.id = m.id_topic
                WHERE id_board = :idBoard 
                ORDER BY m.edition_date DESC
                LIMIT 3
                ';

            $reqTopics = $db->prepare($queryTopics);
            $reqTopics->execute(array(
                'idBoard'=> $board["id"]
            ));
            $topics = $reqTopics->fetchAll();

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
        }
        ?>
    </tbody>
</table>
<!-- <table class="table">
  <tbody>
    <tr class="board">
      <th scope="row">General</th>
    </tr>
    <tr class="topic">
      <th scope="row">Topic 1</th>
    </tr>
    <tr class="board">
      <th scope="row">Development</th>
    </tr>
    <tr class="board">
      <th scope="row">Smalltalk</th>
    </tr>
    <tr class="board">
      <th scope="row">Events</th>
    </tr>
  </tbody>
</table> -->

<?php
include('_footer.php');
?>

