<?php
require __DIR__ . "/database.php";
$pdo = connectToDbAndGetPdo();

$user_id   = intval($_POST["user_id"] ?? 0);
$game_id   = intval($_POST["game_id"] ?? 0);
$difficulty = $_POST["difficulty"] ?? null;
$score     = intval($_POST["score"] ?? 0);

if ($user_id && $game_id && in_array($difficulty, ['1','2','3'])) {

    $stmt = $pdo->prepare("INSERT INTO score (user_id, game_id, difficulty, score) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $game_id, $difficulty, $score]);
    echo "OK";

} else {
    echo "INVALID DATA";
}