<?php
session_start();

require "../projet/utils/database.php";
$pdo = connectToDbAndGetPdo();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_pseudo'] = $user['pseudo'];

            header("Location: /Projet-Flash/projet/game/memory/index.php");
            exit();
        } else {
            $message = "Email ou mot de passe incorrect";
        }
    } else {
        $message = "Email ou mot de passe incorrect";
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
                <h1>Heureux de vous revoir 👋</h1>
                <p>Connectez-vous pour retrouver vos scores, reprendre vos parties et défier vos amis en quelques clics.</p>

                <?php if ($message): ?>
                    <p class="message">
                        <?php echo $message; ?>
                    </p>
                <?php endif; ?>

                <form method="post">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Example@email.com" required>
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="8 caractères minimum" required>
                    <div class="forgot-password">
                        <a>Mot de passe oublié ? </a>
                    </div>
                    <button type="submit" class="login-btn">Connexion</button>
                </form>

                <div class="or">
                    <span class="line"></span>
                    <span>OU</span>
                    <span class="line"></span>
                </div>

                <a class="login-with-google"> <img src="../assets/img/google.png">Se connecter avec Google</a>

                <div class="no-account">
                    <p>Pas de compte ? </p> <a href="./register.php">Je m'inscris</a>
                </div>
            </div>
        </div>

        <div class="right">
            <img src="../assets/img/Art.png">
        </div>
    </div>

</body>

</html>