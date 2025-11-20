<?php
require "../projet/utils/userConexion.php";
require "../projet/utils/database.php";

$pdo = connectToDbAndGetPdo();
$user_id = $_SESSION['user_id'];

$sql = "SELECT email, pseudo, profile_picture FROM user WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (isset($_FILES['profile_picture'])) {
    $fichier = $_FILES['profile_picture'];
    $nouveau_nom = "user_" . $user_id . "_" . time() . ".jpg";

    move_uploaded_file($fichier['tmp_name'], "../usersfiles/" . $nouveau_nom);

    $sql = "UPDATE user SET profile_picture = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nouveau_nom, $user_id]);

    $user['profile_picture'] = $nouveau_nom;
}

if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    if (!empty($mdp)) {
        $mdp_crypte = password_hash($mdp, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET email = ?, pseudo = ?, password = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $pseudo, $mdp_crypte, $user_id]);
    } else {
        $sql = "UPDATE user SET email = ?, pseudo = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $pseudo, $user_id]);
    }

    $_SESSION['user_pseudo'] = $pseudo;
    $user['pseudo'] = $pseudo;
    $user['email'] = $email;
}

$photo = !empty($user['profile_picture'])
    ? "../usersfiles/" . $user['profile_picture']
    : "../assets/img/profil-pp.jpg";

function getBestScore($user_id, $difficulty)
{
    global $pdo;
    $sql = "SELECT MIN(score) as best_score FROM score WHERE user_id = ? AND difficulty = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $difficulty]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['best_score'];
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
                    <div class="profile-picture-wrapper">
                        <img src="<?php echo $photo; ?>" alt="Photo" id="profile-preview">

                        <div class="edit-pp">
                            <form method="post" enctype="multipart/form-data" id="profile-pic-form">
                                <label for="change-pp" class="edit-pp-btn">
                                    <i class="ri-pencil-fill"></i>
                                </label>
                                <input type="file" id="change-pp" name="profile_picture" style="display: none;">
                            </form>
                        </div>
                    </div>

                    <div>
                        <h2><?php echo $_SESSION['user_pseudo']; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <section class="profil">
                <h1>Modifier mon profil</h1>

                <div class="flex-items">
                    <form method="post">
                        <label for="pseudo"><i class="ri-pencil-ai-line"></i> Nom d'utilisateur</label>
                        <input type="text" id="pseudo" name="pseudo" value="<?php echo $user['pseudo']; ?>" required>

                        <label for="email"><i class="ri-pencil-ai-line"></i> Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

                        <label for="password"><i class="ri-pencil-ai-line"></i> Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Laisser vide si pas de changement">

                        <button type="submit">Modifier</button>
                    </form>

                    <div class="best-score">
                        <h1>Meilleurs scores</h1>
                        <div class="score easy">
                            <span><i class="ri-emotion-happy-line"></i> Facile</span>
                            <span><?php echo getBestScore($_SESSION["user_id"], 1); ?>s</span>
                        </div>
                        <div class="score medium">
                            <span><i class="ri-emotion-normal-line"></i> Moyen</span>
                            <span><?php echo getBestScore($_SESSION["user_id"], 2); ?>s</span>
                        </div>
                        <div class="score hard">
                            <span><i class="ri-emotion-unhappy-line"></i> Difficile</span>
                            <span><?php echo getBestScore($_SESSION["user_id"], 3); ?>s</span>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>

    <?php include "../projet/partials/footer.php" ?>

    <script src="/Projet-flash/assets/js/header.js"></script>
    <script>
        document.getElementById('change-pp').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
                document.getElementById('profile-pic-form').submit();
            }
        });
    </script>
</body>

</html>