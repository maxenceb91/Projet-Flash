<?php
session_start();
require __DIR__ . "/database.php";
$pdo = connectToDbAndGetPdo();

$user_id   = $_SESSION["user_id"];
$game_id   = $_POST["game_id"];
$difficulty = $_POST["difficulty"];
$score = $_POST["score"];

$stmt = $pdo->prepare("INSERT INTO score (user_id, game_id, difficulty, score) VALUES (?, ?, ?, ?)");
$stmt->execute([$user_id, $game_id, $difficulty, $score]);