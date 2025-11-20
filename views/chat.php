<?php
global $pdo;

$request = $pdo->prepare('SELECT 
message.message,
user.pseudo,
user.id,
TIMESTAMPDIFF(MINUTE, message.created_at, NOW()) AS minutes_ago
FROM message
JOIN user ON user.id = message.user_id
WHERE message.created_at >= NOW() - INTERVAL 24 HOUR
ORDER BY message.created_at ASC;');

$request->execute();
$messages = $request->fetchAll();

function isUser($pseudo)
{
    return (isset($_SESSION["user_pseudo"]) && $_SESSION["user_pseudo"] == $pseudo);
}

function addMessage($game, $sender_id, $message)
{
    global $pdo;
    $request = $pdo->prepare('INSERT INTO message (game_id, user_id, message, created_at) VALUES (?, ?, ?, NOW());'); // Ajout de NOW()
    $request->bindValue(1, $game, PDO::PARAM_INT);
    $request->bindValue(2, $sender_id, PDO::PARAM_INT);
    $request->bindValue(3, $message, PDO::PARAM_STR);
    $request->execute();
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = trim($_POST['msg']);
    if (empty($msg)) {
        return;
    }

    if (isset($_SESSION["user_id"])) {
        addMessage(1, $_SESSION["user_id"], $msg);
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}
?>

<section class="chat-section">
    <div class="head-chat">
        <button><i class="ri-arrow-left-s-line"></i></button>
        <p>Power Of Memory</p>
    </div>

    <div class="chat">
        <?php foreach ($messages as $message): ?>
            <div class="<?= isUser($message["pseudo"]) ? 'msg-me' : 'msg-dt' ?>">

                <?php if (!isUser($message["pseudo"])): ?>
                    <div class="msg-dt-container">
                    <?php endif; ?>

                    <figure>
                        <img class="pp" src="<?= htmlspecialchars(getPhoto($pdo, $message["id"])) ?>" alt="PP de <?= htmlspecialchars($message["pseudo"]) ?>">
                        <figcaption>
                            <?php echo htmlspecialchars($message["pseudo"]) ?>
                        </figcaption>
                    </figure>

                    <div class="msg">
                        <span class="<?= isUser($message["pseudo"]) ? 'blue' : '' ?>">
                            <?= htmlspecialchars($message["message"]) ?>
                        </span>
                    </div>

                    <?php if (!isUser($message["pseudo"])): ?>
                    </div>
                <?php endif; ?>

                <small><?= formatMinutesAgo($message["minutes_ago"]) ?></small>
            </div>
        <?php endforeach; ?>

        <?php
        $api = "https://api.thecatapi.com/v1/images/search?mime_types=gif";
        $json = file_get_contents($api);
        $data = json_decode($json, true);
        $gifUrl = $data[0]['url'] ?? null;
        ?>

        <?php if ($gifUrl): ?>
            <img src="<?= htmlspecialchars($gifUrl) ?>" alt="Chat GIF">
        <?php else: ?>
            <p>Impossible de charger le GIF.</p>
        <?php endif; ?>
    </div>

    <form method="post">
        <label for="msg">Votre message</label>
        <input type="text" id="msg" name="msg" placeholder="Votre message" autocomplete="off">
        <button type="submit" style="display:none;"></button>
    </form>
</section>

<button class="btn-chat"><i class="ri-arrow-down-s-line"></i></button>