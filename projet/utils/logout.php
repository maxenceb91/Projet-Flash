<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: /Projet-flash/index.php");
exit();
?>