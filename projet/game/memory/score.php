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
    include "../../partials/header.php"
    ?>

    <div class="container">

        <!--hero section -->
        
        <section class="hero">
            <h1>Classement</h1>
            <p>Consultez les meilleurs temps et les performances des joueurs sur nos mini-jeux. Défiez vos amis ou tentez de grimper dans le top chaque jour.</p>
        </section>


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
                    <tr>
                        <td>1</td>
                        <td><img src="/Projet-flash/assets/img/game.png" alt="jeu"><span>Power Of Memory</span></td>
                        <td>John Doe</td>
                        <td>Difficile</td>
                        <td>1m36</td>
                        <td>29/09/25</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="/Projet-flash/assets/img/game.png" alt="jeu"><span>Power Of Memory</span></td>
                        <td>Joueur 2</td>
                        <td>Difficile</td>
                        <td>1m39</td>
                        <td>29/09/25</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="/Projet-flash/assets/img/game.png" alt="jeu"><span>Power Of Memory</span></td>
                        <td>Joueur 3</td>
                        <td>Difficile</td>
                        <td>1m40</td>
                        <td>29/09/25</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><img src="/Projet-flash/assets/img/game.png" alt="jeu"><span>Power Of Memory</span></td>
                        <td>Joueur 4</td>
                        <td>Difficile</td>
                        <td>1m50</td>
                        <td>29/09/25</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><img src="/Projet-flash/assets/img/game.png" alt="jeu"><span>Power Of Memory</span></td>
                        <td>Joueur 5</td>
                        <td>Difficile</td>
                        <td>2m01</td>
                        <td>29/09/25</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><img src="/Projet-flash/assets/img/game.png" alt="jeu"><span>Power Of Memory</span></td>
                        <td>Joueur 6</td>
                        <td>Difficile</td>
                        <td>2m34</td>
                        <td>29/09/25</td>
                    </tr>
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

</html>
