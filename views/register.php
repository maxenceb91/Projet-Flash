<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style/auth.css">
</head>

<body>

    <div class="global-container">
        <div class="left">
            <div class="left-container">
                <h1>Bienvenu chez nous !  👋</h1>
                <p>Créez un compte pour sauvegarder vos scores, suivre vos progrès et participer aux classements.</p>
                    
                <form method="post">
                    <label>Email</label>
                    <input type="email" placeholder="Example@email.com">
                    <label>Mot de passe</label>
                    <input type="password" placeholder="8 caractères minimum">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" placeholder="8 caractères minimum">
                
                    <button type="submit" class="login-btn">Inscription</button>
                </form>

                <div class="or">
                    <span class="line"></span>
                    <span>OU</span>
                    <span class="line"></span>
                </div>

                <a class="login-with-google"> <img src="../assets/img/google.png">M'inscrire avec Google</a>

                <div class="no-account">
                    <p>Déjà un compte ? </p> <a href="./login.html">Je me connecte</a>
                </div>
            </div>
        </div>

        <div class="right">
            <img src="../assets/img/Art.png">
        </div>
    </div>

</body>

</html>
