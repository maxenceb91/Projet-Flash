<?php
require "../../../projet/utils/database.php";
require "../../utils/userConexion.php"; 


$pdo = connectToDbAndGetPdo();

function getScores()
{
    global $pdo;
    $request = $pdo->prepare('
        SELECT 
            game.name AS game_name, 
            user.pseudo AS user_pseudo, 
            score.difficulty, 
            score.score, 
            score.created_at 
        FROM `score`
        JOIN `user` ON user.id = score.user_id
        JOIN `game` ON game.id = score.game_id
        ORDER BY game.name, difficulty DESC, score DESC;
    ');
    $request->execute();
    return $request->fetchAll();
}

function displayDifficulty($difficulty)
{
    switch ($difficulty):
        case 1:
            return "Facile";
        case 2:
            return "Moyen";
        case 3:
            return "Difficile";
        default:
            return "Inconnu";
    endswitch;
}

function getQuery()
{
    if (isset($_GET["q"])) {
        return $_GET["q"];
    } else {
        return "";
    }
}

function getSearchScore($char)
{
    if ($char == "") {
        return getScores();
    }

    global $pdo;
    $request = $pdo->prepare('
        SELECT 
            game.name AS game_name, 
            user.pseudo AS user_pseudo, 
            score.difficulty, 
            score.score, 
            score.created_at 
        FROM score
        JOIN user ON user.id = score.user_id
        JOIN game ON game.id = score.game_id
        WHERE user.pseudo LIKE :char
        ORDER BY game.name, score.difficulty DESC, score.score DESC
    ');

    $request->execute(['char' => "%$char%"]);

    return $request->fetchAll();
}
function isPlayer($pseudo){
    if (isset($_SESSION['user_pseudo'])){
        return $_SESSION['user_pseudo'] == $pseudo;
    }
    return false;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include "../../partials/head.php"
    ?>
    <link rel="stylesheet" href="/Projet-flash/assets/style/score.css">
</head>

<body>

    <?php
    $page = 'scores';
    include "../../partials/header.php"
    ?>

    <div class="container">

        <!--hero section -->

        <section class="hero">
            <h1>Classement</h1>
            <p>Consultez les meilleurs temps et les performances des joueurs sur nos mini-jeux. Défiez vos amis ou tentez de grimper dans le top chaque jour.</p>
        </section>

        <div class="settings">
            <form class="search-bar" method="get">
                <label for="search-bar">Rechercher</label>
                <input id="search-bar" value="<?= htmlspecialchars(getQuery()) ?>" name="q" type="text">
            </form>

            <div>
                <label for="difficulty">Difficulté</label>
                <select id="difficulty" name="difficulty">
                    <option value="1">Facile</option>
                    <option value="2">Moyen</option>
                    <option value="3">Difficile</option>
                </select>
            </div>
        </div>

        <section class="scoreboard">
            <table>
                <thead>
                    <tr class="head-tr">
                        <th>#</th>
                        <th>Jeu</th>
                        <th>Joueur</th>
                        <th>Difficulté</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $scores = getSearchScore(getQuery());
                    $i = 0;
                    foreach ($scores as $score) {
                        $i++;

                        $class = (isPlayer($score['user_pseudo'])) ? 'highlight' : '';

                        echo '<tr>' .
                            '<td>' . $i . '</td>' .
                            '<td>' . '<img src="/Projet-flash/assets/img/game.png" alt="jeu">'
                            . '<span>' . $score['game_name'] . '</span>' . '</td>' .
                            '<td class="' . $class . '">' . $score['user_pseudo'] . '</td>' .
                            '<td>' . displayDifficulty($score['difficulty']) . '</td>' .
                            '<td>' . $score['score'] . '</td>' .
                            '<td>' . $score['created_at'] . '</td>' .
                            '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="flex-2">
            <div>
                <h2>Relevez le défi</h2>
                <p>Comparez vos performances, découvrez les astuces et améliorez vos temps sur Power Of Memory. Les tableaux affichent les meilleurs scores enregistrés — tentez d’atteindre le sommet !</p>

                <p>Choisissez un mode de difficulté, entraînez-vous et revenez vérifier le classement régulièrement pour voir si votre nom apparaît.</p>

                <button>Jouer</button>

            </div>

            <img src="/Projet-flash/assets/img/aaa.png">
        </section>
    </div>

    <footer>
        <div class="footer-top">
            <div>
                <h2>GameBase</h2>
                <p>GameBase est votre plateforme de mini-jeux en ligne rapides et amusants. Défiez vos amis, battez des records et amusez-vous à tout moment depuis votre navigateur.</p>
            </div>
            <div>
                <h3>Menu</h3>
                <nav>
                    <ul>
                        <li>
                            <a>Accueil</a>
                        </li>

                        <li>
                            <a>Scores</a>
                        </li>

                        <li>
                            <a>Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div>

                <h3>Contactez-nous</h3>
                <p>Une question, une suggestion ou un bug à signaler ? Notre équipe est disponible pour vous répondre rapidement.</p>

                <p class="mail">contact@gamebase.com</p>
            </div>
            <div class="social">
                <div>

                    <i class="ri-facebook-line"></i>

                    <i class="ri-instagram-line"></i>

                    <i class="ri-twitter-line"></i>

                    <i class="ri-linkedin-line"></i>
                </div>
            </div>
        </div>

        <hr>

        <div class="footer-bottom">
            <p>Copyright ® 2025 All rights Reserved - GameBase</p>
        </div>
    </footer>


</body>
<script src="/Projet-flash/assets/js/header.js"></script>
</html>