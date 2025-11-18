<?php 
require "../projet/utils/userConexion.php";
require "../projet/utils/database.php";

$pdo = connectToDbAndGetPdo();
$message = "";

$user_id = $_SESSION['user_id'];
$sql = "SELECT email, pseudo FROM user WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_pseudo = $_POST['pseudo'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    
    if (strlen($new_pseudo) < 4) {
        $message = "Le pseudo doit avoir au moins 4 caractères";
    }
    elseif (!empty($new_password)) {
        if (strlen($new_password) < 8) {
            $message = "Le mot de passe doit avoir au moins 8 caractères";
        }
        elseif ($new_password !== $confirm_password) {
            $message = "Les mots de passe ne correspondent pas";
        }
        else {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET email = ?, pseudo = ?, password = ?, updated_at = NOW() WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$new_email, $new_pseudo, $hashedPassword, $user_id]);
            
            $_SESSION['user_pseudo'] = $new_pseudo;
            $user['pseudo'] = $new_pseudo;
            $user['email'] = $new_email;
            $message = "Profil modifié avec succès !";
        }
    }
    else {
        $sql = "UPDATE user SET email = ?, pseudo = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_email, $new_pseudo, $user_id]);
        
        $_SESSION['user_pseudo'] = $new_pseudo;
        $user['pseudo'] = $new_pseudo;
        $user['email'] = $new_email;
        $message = "Profil modifié avec succès !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once "../projet/partials/head.php" ?>
    <link rel="stylesheet" href="../assets/style/profil.css">
</head>

<body>
    <?php
    $page = 'profil';
    include "../projet/partials/header.php"
    ?>

    <main>
        <div class="banner">
            <div class="container-banner">
                <div class="banner-content">
                    <img src="../assets/img/profil-pp.jpg">
                    <div>
                        <h2><?php echo $_SESSION['user_pseudo']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <section class="profil">
                <h1>Modifier mon profil</h1>

                <?php if ($message): ?>
                    <p class="message">
                        <?php echo $message; ?>
                    </p>
                <?php endif; ?>

                <form method="post">
                    <label for="pseudo">Nom d'utilisateur</label>
                    <input type="text" id="pseudo" name="pseudo" value="<?php echo htmlspecialchars($user['pseudo']); ?>" required>

                    <label for="email">Adresse Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                    <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                    <input type="password" id="password" name="password" placeholder="8 caractères minimum">

                    <label for="confirmPassword">Confirmer le nouveau mot de passe</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="8 caractères minimum">

                    <button type="submit">Confirmer les modifications</button>
                </form>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?php include "../projet/partials/footer.php" ?>
</body>
<script src="/Projet-flash/assets/js/header.js"></script>
</html>