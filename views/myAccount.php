<!DOCTYPE html>
<html lang="fr">

<head>
<?php 
include_once "../projet/partials/head.php"
?>
<link rel="stylesheet" href="../assets/style/profil.css">
</head>
<body>
    <?php
    include "../projet/partials/header.php"
    ?>

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
     <?php
    include "../projet/partials/footer.php"
    ?>
</body>

</html>