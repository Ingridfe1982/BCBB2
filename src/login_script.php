<?php
if (empty(session_id())) {session_start();}
// var_dump($_POST); die;
include_once("_functions.php");
$db = openDb();

login($db, $_POST);

