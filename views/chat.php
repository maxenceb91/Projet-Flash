<?php
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

function isUser($pseudo)
{
    return (isset($_SESSION["user_pseudo"]) && $_SESSION["user_pseudo"] == $pseudo);
}

function formatMinutesAgo($minutes)
{
    if ($minutes < 1) {
        return "À l'instant";
    }

    if ($minutes < 60) {
        return "Il y a " . $minutes . " minute" . ($minutes > 1 ? "s" : "");
    }

    $hours = floor($minutes / 60);
    if ($hours < 24) {
        return "Il y a " . $hours . " heure" . ($hours > 1 ? "s" : "");
    }

    $days = floor($hours / 24);
    return "Il y a " . $days . " jour" . ($days > 1 ? "s" : "");
}

function getPhoto($pdo, $user_id)
{
    $sql = "SELECT profile_picture FROM user WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    $photo = !empty($user['profile_picture'])
        ? "/Projet-flash/usersfiles/" . htmlspecialchars($user['profile_picture'])
        : "/Projet-flash/assets/img/profil-pp.jpg";

    return $photo;
}

function formatPseudo($pseudo)
{
    $parts = explode(' ', trim($pseudo));

    if (count($parts) >= 2) {
        $firstName = $parts[0];
        $lastNameInitial = substr($parts[1], 0, 1) . '.';
        return $firstName . ' ' . $lastNameInitial;
    }

    return $pseudo;
}
?>

<section class="chat-section">

    <div class="head-chat">
        <button><i class="ri-arrow-left-s-line"></i></button>
        <p>Power Of Memory</p>
    </div>

    <div class="chat">
        <?php
        include __DIR__ . '/utils/load_messages.php';
        ?>
    </div>

    <form>
        <label for="msg" style="display:none;">Votre message</label>
        <input type="text" id="msg" name="message" placeholder="Votre message" autocomplete="off" required>
        <button type="submit" style="display:none;"></button>
    </form>

</section>

<button class="btn-chat"><i class="ri-arrow-down-s-line"></i></button>

<script src="/Projet-flash/assets/js/chat.js"></script>