<?php

require "./projet/utils/database.php";
$pdo = connectToDbAndGetPdo();

function getPlayedGames()
{
    global $pdo;
    $request = $pdo->prepare('SELECT COUNT(*) as total FROM score');
    $request->execute();
    $result = $request->fetch();
    return $result['total'];
}

function getConnectedUsers()
{
    return 0;
}

function getRecordTime()
{
    global $pdo;
    $request = $pdo->prepare('SELECT MIN(score) as min FROM score');
    $request->execute();
    $result = $request->fetch();
    return $result['min'];
}

function getRegisteredUsers()
{
    global $pdo;
    $request = $pdo->prepare('SELECT COUNT(*) as total FROM user');
    $request->execute();
    $result = $request->fetch();
    return $result['total'];
}

function getBeatenScoresInDifficulty($difficulty)
{
    global $pdo;

    $sql = "
    SELECT
        COUNT(t1.id) AS total_records
    FROM
        score t1
    WHERE
        DATE(t1.created_at) = CURRENT_DATE()
        AND t1.difficulty = :difficulty
        AND t1.score <= COALESCE((
            SELECT
                MIN(t2.score)
            FROM
                score t2
            WHERE
                t2.user_id = t1.user_id
                AND t2.game_id = t1.game_id
                AND t2.difficulty = t1.difficulty
                AND DATE(t2.created_at) < CURRENT_DATE()
        ), t1.score + 1);
    ";

    $request = $pdo->prepare($sql);
    $request->execute([':difficulty' => $difficulty]);
    $total = $request->fetchColumn();
    return $total;
}

function getBeatenScores()
{
    $total = 0;
    for ($i = 0; $i < 3; $i++) {
        $total += getBeatenScoresInDifficulty($i + 1);
    }

    return $total;
}

session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Base</title>
    <link rel="icon" type="image/png" href="./assets/img/logo.png">
    <link rel="stylesheet" href="./assets/style/index.css">
    <link rel="stylesheet" href="./assets/style/header.css">
    <link rel="stylesheet" href="./assets/style/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <!--Header-->
    <?php
    $page = 'accueil';
    include "./projet/partials/header.php"
    ?>
    <div class="container">

        <!--Hero section-->
        <section class="hero-section" data-aos="fade-up">
            <small>Jouez. Mémorisez. Gagnez.</small>
            <h1>Des jeux rapides et addictifs</h1>
            <p>GameBase vous propose des mini-jeux amusants et rapides pour défier votre mémoire, votre vitesse et vos réflexes. Défiez vos amis, améliorez vos scores et amusez-vous en quelques minutes seulement.</p>
            <a href="<?php echo isset($_SESSION['user_id']) ? './projet/game/memory/index.php' : './views/login.php'; ?>">
                Commencer !
            </a>

            <img src="./assets/img/Banner-Image.png">
            
        </section>

        <section class="game-section" data-aos="fade-up" data-aos-duration="1500">
            <h2>Nos jeux</h2>

            <div class="flex">
                <figure>
                    <img src="./assets/img/Memory 1.png" alt="Jeu de mémoire GameBase">
                    <figcaption>Power Of Memory</figcaption>
                </figure>

                <figure>
                    <img src="./assets/img/Controller.png" alt="Mini-jeu GameBase">
                    <figcaption>Reflex Challenge</figcaption>
                </figure>

                <figure>
                    <img src="./assets/img/Controller.png" alt="Mini-jeu GameBase">
                    <figcaption>Speed Clicker</figcaption>
                </figure>
            </div>
        </section>

        <h2 class="title">Jouez quelques minutes par jour pour améliorer votre attention et votre mémoire.</h2>

        <section class="desc">
            <h2>Pourquoi GameBase ?</h2>
            <p>GameBase n’est pas seulement une plateforme de jeux, c’est un espace où chaque partie est une opportunité d’entraîner votre cerveau, de vous détendre et de vous challenger avec vos amis.</p>
        </section>

    </div>
    <section class="game-img-section">
        <img src="./assets/img/VideoGame 2.png" class="img-bg">
        <img src="./assets/img/Grid.png" class="grid-img">
    </section>

    <!--Stats section-->
    <section class="stats">
        <div class="container">
            <h2>Un univers pensé pour les joueurs</h2>
            <p>Chaque jour, des milliers de joueurs se connectent sur GameBase pour se divertir, battre des records et grimper dans le classement. Et vous, jusqu’où irez-vous ?</p>

            <div class="flex-3">
                <span class="stat stat-blue">
                    <span><?php echo getPlayedGames() ?></span>
                    <small>Parties Jouées</small>
                </span>

                <span class="stat stat-white">
                    <span><?php echo getConnectedUsers() ?></span>
                    <small>Joueurs Connectés</small>
                </span>

                <span class="stat stat-orange">
                    <span><?php echo getRecordTime() ?></span>
                    <small>Temps Record</small>
                </span>
            </div>

            <div class="flex-2">
                <span class="stat stat-red">
                    <span><?php echo getRegisteredUsers() ?></span>
                    <small>Joueurs Inscrits</small>
                </span>

                <span class="stat stat-orange">
                    <span><?php echo getBeatenScores() ?></span>
                    <small>Records battus aujourd’hui</small>
                </span>
            </div>
        </div>
    </section>

    <!--Crew section-->
    <section class="crew">
        <h2>Notre équipe</h2>
        <p>Derrière GameBase, une équipe passionnée travaille pour vous proposer des expériences de jeu toujours plus fun et stimulantes.</p>

        <div class="flex-3">
            <figure>
                <img src="./assets/img/member1.jpeg" alt="Thomas Galabert">
                <figcaption>Thomas Galabert</figcaption>
            </figure>

            <figure>
                <img src="./assets/img/member2.png" alt="Maxence Boisseau">
                <figcaption>Maxence Boisseau</figcaption>
            </figure>
        </div>

    </section>

    <div class="container">
        <section class="desc">
            <h2>Un divertissement accessible</h2>
            <p>Pas besoin de longues sessions, GameBase est pensé pour des parties rapides qui s’adaptent à votre quotidien. Que vous soyez seul ou avec des amis, vous trouverez toujours un défi à relever.</p>
        </section>

        <!--Newslatter section-->
        <div class="banner">
            <div>
                <h2>Restez informé</h2>
                <p>Inscrivez-vous à notre newsletter pour recevoir les dernières nouveautés, les mises à jour des jeux et les classements hebdomadaires.</p>
            </div>

            <form method="post">
                <input type="email" placeholder="Adresse email">
                <button class="confirm-btn">Valider</button>
            </form>
        </div>
    </div>

    <!--Footer-->
    <?php
    include "./projet/partials/footer.php"
    ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="/Projet-flash/assets/js/header.js"></script>
</body>

</html>