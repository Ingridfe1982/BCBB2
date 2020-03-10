<?php
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