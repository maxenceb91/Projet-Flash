<header>
    <?php
    if (!isset($photo) && (isset($_SESSION['user_id']) || isset($_SESSION['id']))) {
        require __DIR__ . "/../utils/database.php";
        $pdo = connectToDbAndGetPdo();

        $user_id = $_SESSION['user_id'] ?? $_SESSION['id'];

        $stmt = $pdo->prepare("SELECT profile_picture FROM user WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        $photo = (!empty($user['profile_picture']))
            ? "/Projet-flash/usersfiles/" . $user['profile_picture']
            : "/Projet-flash/assets/img/profil-pp.jpg";
    }

    $page = $page ?? null;

    function activeClass($current, $expected) {
        return ($current === $expected) ? ' class="header-selected"' : '';
    }
    ?>

    <a href="/Projet-flash/index.php">
        <img src="/Projet-flash/assets/img/logo.png" class="logo" alt="logo">
    </a>

    <nav>
        <a href="/Projet-flash/index.php"<?= activeClass($page, 'accueil') ?>>Accueil</a>

        <a href="/Projet-flash/projet/game/memory/score.php"<?= activeClass($page, 'scores') ?>>Scores</a>

        <a class="contact-btn" href="/Projet-flash/views/contact.php">Nous contacter</a>

        <?php if (isset($_SESSION['user_id']) || isset($_SESSION['id'])): ?>
            <img src="<?= $photo ?>" class="pp-menu">

            <div class="menu">
                <a href="/Projet-flash/views/myAccount.php"><i class="ri-user-line"></i> Profil</a>
                <a class="logout-btn" href="/Projet-flash/projet/utils/logout.php">
                    <i class="ri-logout-box-line"></i> Déconnexion
                </a>
            </div>

        <?php else: ?>
            <a class="contact-btn" href="/Projet-flash/views/login.php">Connexion</a>
        <?php endif; ?>
    </nav>

    <div class="burger-menu">
        <div class="burger-container">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>

<script src="/Projet-flash/assets/js/header.js"></script>
