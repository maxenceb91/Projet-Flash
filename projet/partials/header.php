<header>
    <a href="/Projet-flash/index.php">
        <img src="./assets/img/logo.png" class="logo" alt="logo">
    </a>
    <nav>
        <a href="/Projet-flash/index.php" class="<?php if($page == 'accueil') echo 'header-selected'; ?>">Accueil</a>
        <a href="/Projet-flash/projet/game/memory/score.php" class="<?php if($page == 'scores') echo 'header-selected'; ?>">Scores</a>
        <a href="/Projet-flash/views/myAccount.php" class="<?php if($page == 'profil') echo 'header-selected'; ?>">Profil</a>
        <a class="contact-btn " href="/Projet-flash/views/contact.php">Nous contacter</a>
    </nav>
    <div class="burger-menu">
        <div class="burger-container">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>