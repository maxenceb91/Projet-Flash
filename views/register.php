<?php
require "../projet/utils/database.php";
$pdo = connectToDbAndGetPdo();
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    
    if (strlen($pseudo) < 4) {
        $message = "Le pseudo doit avoir au moins 4 caractères";
    }
    elseif (strlen($password) < 8) {
        $message = "Le mot de passe doit avoir au moins 8 caractères";
    }
    elseif ($password !== $confirm) {
        $message = "Les mots de passe ne correspondent pas";
    }
    else {
        $sqlCheck = "SELECT COUNT(*) FROM user WHERE email = ?";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->execute([$email]);
        $emailExists = $stmtCheck->fetchColumn();
        
        if ($emailExists > 0) {
            $message = "Cette adresse email est déjà utilisée";
        }
        else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (email, password, pseudo, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $hashedPassword, $pseudo]);
            $message = "Inscription réussie ! Vous pouvez vous connecter.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../projet/partials/head.php"; ?>
    <link rel="stylesheet" href="../assets/style/auth.css">
</head>
<body>
    <div class="global-container">
        <div class="left">
            <div class="left-container">
                <h1>Bienvenu chez nous ! 👋</h1>
                <p>Créez un compte pour sauvegarder vos scores, suivre vos progrès et participer aux classements.</p>
                <?php if ($message): ?>
                    <p class="message">
                        <?php echo $message; ?>
                    </p>
                <?php endif; ?>
                <form method="post">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Example@email.com" required>
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" placeholder="Minimum 4 caractères" required>
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="8 caractères minimum" required>
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="confirm_password" placeholder="8 caractères minimum" required>
                    <button type="submit" class="login-btn">Inscription</button>
                </form>
                <div class="or">
                    <span class="line"></span>
                    <span>OU</span>
                    <span class="line"></span>
                </div>
                <a class="login-with-google"> 
                    <img src="../assets/img/google.png">M'inscrire avec Google
                </a>
                <div class="no-account">
                    <p>Déjà un compte ? </p> <a href="./login.php">Je me connecte</a>
                </div>
            </div>
        </div>
        <div class="right">
            <img src="../assets/img/Art.png">
        </div>
    </div>
</body>
</html>