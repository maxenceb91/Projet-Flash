<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /Projet-Flash/views/login.php");
    exit();
}

?>