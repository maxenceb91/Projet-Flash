<?php 
require "../../utils/userConexion.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include "../../partials/head.php"
    ?>

    <link rel="stylesheet" href="/Projet-flash/assets/style/game.css">
</head>

<body>
    <?php
    include "../../partials/header.php"
    ?>

    <?php
    include "../../../views/chat.php"
    ?>

    <div class="title">
        <h1>The Power Of Memory</h1>
        <p>Un jeu simple et addictif pour entraîner votre mémoire ! Retournez les cartes, trouvez les paires et tentez de battre votre meilleur temps.</p>
    </div>

    <div class="game">
        <div class="parameters">
            <div>
                <label for="size">TAILLE DE LA GRILLE :</label>
                <select id="size" name="size">
                    <option value="4x4">4x4</option>
                    <option value="6x6">6x6</option>
                    <option value="10x10">10x10</option>
                </select>
            </div>

            <div>
                <label for="theme">THÈMES:</label>
                <select id="theme" name="theme">
                    <option value="JeuxVidéo">JeuxVidéo</option>
                </select>
            </div>
            <button>Générer une grille</button>
        </div>
    </div>

    <div class="grid">
       
    </div>


    <div class="container">
        <div class="content">
            <div>
                <h2>Améliorez votre mémoire tout en vous amusant</h2>
                <p>Power of Memory est conçu pour stimuler vos capacités cognitives de manière ludique. En retrouvant les paires de cartes, vous travaillez votre concentration, votre vitesse et votre mémoire visuelle.</p>
                <p>Choisissez la taille de votre grille, sélectionnez un thème et tentez de battre vos propres records ou ceux de vos amis.</p>
                <button>Jouer</button>
            </div>
            <img src="/Projet-flash/assets/img/aaa.png" alt="game image">
        </div>
    </div>

    <!-- Footer -->
    <?php
    include "../../partials/footer.php"
    ?>
</body>

<script src="/Projet-flash/assets/js/index.js"></script>
<script src="/Projet-flash/assets/js/header.js"></script>
<script src="/Projet-flash/assets/js/game.js"></script>
</html>