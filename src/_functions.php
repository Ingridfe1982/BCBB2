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
        'editionDate' => null,
        'userId' => $userId,
        'topicId' => $topicId
    ));
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
    
    $_SESSION["nickname"] = $userData['nickname'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION["userId"] = $userData['id_user'] ;
    
    header("Location: index.php");
}

function checkAccessUser() {
    
}