<?php
if (empty(session_id())) {session_start();}
session_unset();
header("Location: index.php");

?>