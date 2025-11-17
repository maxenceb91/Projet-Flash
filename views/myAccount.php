<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/profil.css">
    <link rel="stylesheet" href="../assets/style/header.css">
    <link rel="stylesheet" href="../assets/style/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    <title>Game</title>
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

    <main>
        <div class="banner">
            <div class="container-banner">
                <div class="banner-content">
                    <img src="../assets/img/profil-pp.jpg">
                    <div>
                        <h2>Thomas Galabert</h2>
                        <small>Je suis le mec le plus beau du monde</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <section class="profil">
                <h1>Modifier mon profil</h1>

                <form method="post">
                    <label for="pseudo">Nom d'utilisateur</label>
                    <input type="text" id="pseudo" placeholder="Nom d'utilisateur">

                     <label for="email">Adresse Email</label>
                    <input type="email" id="email" placeholder="Adresse email">

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" placeholder="Mot de passe">

                    <label for="confirmPassword">Confirmer le mot de passe</label>
                    <input type="password" id="confirmPassword" placeholder="Confirmer le mot de passe">

                    <label for="bio">A propos</label>
                    <input type="password" id="bio" placeholder="A propos (max 100 caractères)">

                    <button type="submit">Confirmer les modification</button>
                </form>
            </section>
        </div>
    </main>

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

</html>