<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/styles.css">
    <link rel="stylesheet" href="../assets/style/header.css">
    <link rel="stylesheet" href="../assets/style/footer.css">
    <link rel="stylesheet" href="../assets/style/game.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    <title>Game base</title>
</head>

<body>
    <header>
        <a href="../index.html">
            <img src="../assets/img/logo.png" class="logo" alt="logo">
        </a>
        <nav>
            <a href="../index.html">Accueil</a>
            <a href="../views/score.html">Scores</a>
            <a href="../views/profil.html">Profil</a>
            <a class="contact-btn" href="../views/contact.html">Nous contacter</a>
        </nav>

         <div class="burger-menu">
            <div class="burger-container">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

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
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
        <img src="../assets/img/memory_card.jpg" alt="Memory Card">
    </div>

    <div class="container">
        <div class="content">
            <div>
                <h2>Améliorez votre mémoire tout en vous amusant</h2>
                <p>Power of Memory est conçu pour stimuler vos capacités cognitives de manière ludique. En retrouvant les paires de cartes, vous travaillez votre concentration, votre vitesse et votre mémoire visuelle.</p>
                <p>Choisissez la taille de votre grille, sélectionnez un thème et tentez de battre vos propres records ou ceux de vos amis.</p>
                <button>Jouer</button>
            </div>
            <img src="../assets/img/aaa.png" alt="game image">
        </div>
    </div>

    <!-- Footer -->
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

<script src="../assets/js/index.js"></script>
</html>
