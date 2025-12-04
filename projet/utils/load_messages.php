<?php
session_start();
require __DIR__ . "/database.php";
$pdo = connectToDbAndGetPdo();

$request = $pdo->prepare('
SELECT
    t1.message,
    t1.pseudo,
    t1.id,
    TIMESTAMPDIFF(MINUTE, t1.created_at, NOW()) AS minutes_ago
FROM (
    SELECT 
        message.message,
        user.pseudo,
        user.id,
        message.created_at
    FROM message
    JOIN user ON user.id = message.user_id
    WHERE message.created_at >= NOW() - INTERVAL 24 HOUR
    ORDER BY message.created_at DESC
    LIMIT 3
) AS t1
ORDER BY t1.created_at ASC;
');

$request->execute();
$messages = $request->fetchAll();

function isUser($pseudo) {
    return (isset($_SESSION["user_pseudo"]) && $_SESSION["user_pseudo"] == $pseudo);
}

function formatMinutesAgo($minutes) {
    if ($minutes < 1) return "À l'instant";
    if ($minutes < 60) return "Il y a " . $minutes . " minute" . ($minutes > 1 ? "s" : "");
    $hours = floor($minutes / 60);
    if ($hours < 24) return "Il y a " . $hours . " heure" . ($hours > 1 ? "s" : "");
    $days = floor($hours / 24);
    return "Il y a " . $days . " jour" . ($days > 1 ? "s" : "");
}

function getPhoto($pdo, $user_id) {
    $sql = "SELECT profile_picture FROM user WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    return !empty($user['profile_picture'])
        ? "/Projet-flash/usersfiles/" . htmlspecialchars($user['profile_picture'])
        : "/Projet-flash/assets/img/profil-pp.jpg";
}

function formatPseudo($pseudo) {
    $parts = explode(' ', trim($pseudo));
    if (count($parts) >= 2) {
        return $parts[0] . ' ' . substr($parts[1], 0, 1) . '.';
    }
    return $pseudo;
}

foreach ($messages as $message):
    $is_user = isUser($message["pseudo"]);
    $message_class = $is_user ? 'msg-me' : 'msg-dt';
?>
    <div class="<?= $message_class ?>">
        <div class="<?= $is_user ? 'msg-me-container' : 'msg-dt-container' ?>">
            <figure>
                <img class="pp" src="<?= htmlspecialchars(getPhoto($pdo, $message["id"])) ?>" 
                     alt="PP de <?= htmlspecialchars($message["pseudo"]) ?>">
                <figcaption><?= htmlspecialchars(formatPseudo($message["pseudo"])) ?></figcaption>
            </figure>
            <div class="msg">
                <p><?= htmlspecialchars($message["message"]) ?></p>
            </div>
        </div>
        <small><?= formatMinutesAgo($message["minutes_ago"]) ?></small>
    </div>
<?php endforeach; ?>