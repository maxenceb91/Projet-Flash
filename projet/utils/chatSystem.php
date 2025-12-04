<?php
session_start();
require __DIR__ . "/database.php";
$pdo = connectToDbAndGetPdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(403);
        exit('Utilisateur non connecté');
    }

    $game = 1;
    $sender_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare('INSERT INTO message (game_id, user_id, message, created_at) VALUES (?, ?, ?, NOW())');
    $stmt->execute([$game, $sender_id, $_POST['message']]);

    echo("Message envoyé");
}
?>