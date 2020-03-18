<?php
if (empty(session_id())) {session_start();}

function openDb(){
    try
    {
        $db = new PDO('mysql:host=mysql;dbname=bcbb;charset=utf8', 'root', 'root');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

function addMessage($db, $dataForm, $topicId) {
    
    $creationDate = new DateTime("now");
    $userId = $_SESSION["userId"];

    $req = $db->prepare('INSERT INTO messages (content, creation_date, edition_date, id_topic, id_user) 
    VALUES(:content, :creationDate, :editionDate, :topicId, :userId)');
    $req->execute(array(
        'content' => $dataForm['content'],
        'creationDate' => $creationDate->format("Y-m-d H:i:s"),
        'editionDate' => $creationDate->format("Y-m-d H:i:s"),
        'userId' => $userId,
        'topicId' => $topicId
    ));

    header('Location: topic.php?idTopic='.$topicId.'');
}

function login($db, $dataForm) {

    $req = $db->prepare('SELECT * FROM users WHERE email = :email');
    $req->execute(array(
        'email' => $dataForm["email"]
    ));
    // echo '<pre>' . var_export($req->fetch(), true) . '</pre>';die;
    $userData = $req->fetch();
    
    $isPasswordCorrect = password_verify($dataForm['password'], $userData['password']); 
    
    if (!$isPasswordCorrect) {
        header("Location: login.php?error=incorrectPassword");
    }
    
    $_SESSION["userId"] = $userData['id_user'];
    $_SESSION["nickname"] = $userData['nickname'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION["avatar"] = $userData['avatar'];
    
    header("Location: index.php");
}

function ifUserLogOffRedirect() {
    
    if (empty($_SESSION["userId"])) {
        header('Location: login.php?error=userLogOff');die;
    }
}

function checkUserAccess($table, $rowId) {

    switch ($table) {
        case 'messages':

            $db = openDb();

            $req = $db->prepare('SELECT * FROM messages WHERE id_message = :rowId');
            $req->execute(array(
                'rowId' => $rowId
            ));
            $message = $req->fetch();

            if ($_SESSION["userId"] != $message['id_user']) {
                header('Location: '.$_SERVER['HTTP_REFERER'].'');die;
            }
        break;
    }
}

function ifBoardIsSecretAndWrongSecretRedirect($board, $urlParameters) {

    $isSecretBoard = ($board['is_secret'] == 1 ? true : false);
    $secret = $urlParameters['secret'];

    if ($isSecretBoard && $secret !== 'very-secret') {
        header('Location: index.php?error=secretBoard');die;
    }
}