<!DOCTYPE html>
<html lang="fr">


<head>
    <?php
    include_once "../projet/partials/head.php";

    require "../projet/utils/database.php";
    $pdo = connectToDbAndGetPdo();

    session_start();

    $alert_message = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        if (empty($firstName) || empty($lastName) || empty($email) || empty($message)) {
            $alert_message = 1;
        } else {
            $alert_message = 2;
        }
    }
    ?>
    <link rel="stylesheet" href="../assets/style/contact.css">
</head>

<body>

    <?php
    include "../projet/partials/header.php"
    ?>

    <div class="first-container">
        <h1>Restons en contact</h1>
        <small>Une question, une suggestion ou besoin d’assistance ? L’équipe GameBase est là pour vous répondre.</small>
    </div>

    <div class="map-container">
        <img src="../assets/img/map2.png" alt="map">
    </div>

    <div class="container">
        <div class="info-container">
            <div class="social">
                <div class="social-container">
                    <p>Suivez-nous</p>
                    <div>
                        <i class="ri-facebook-line"></i>
                        <i class="ri-instagram-line"></i>
                        <i class="ri-twitter-line"></i>
                        <i class="ri-linkedin-line"></i>
                    </div>
                </div>
            </div>

            <div class="phone">
                <i class="ri-phone-line"></i>
                <p>+33 6 01 02 03 04</p>
            </div>
            <div class="adress">
                <i class="ri-map-pin-line"></i>
                <p>23 rue de Paris, 75002 Paris</p>
            </div>
        </div>
    </div>

    <div class="contact-container">
        <h1>Contactez-nous !</h1>
        <small>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</small>
        <?php if ($alert_message): ?>
            <?php
            if ($alert_message == 1) {
                echo '<p class="error"><i class="ri-calendar-close-line"></i> Certains champs sont vides</p>';
            } else if ($alert_message == 2) {
                echo '<p class="succes"><i class="ri-mail-check-line"></i> Message envoyé avec succès !</p>';
            }
            ?>
        <?php endif; ?>

    </div>

    <form action="" method="post">
        <div class="flex-form">
            <div>
                <label for="firstName">Prénom</label>
                <input type="text" id="firstName" name="firstName">
            </div>
            <div>
                <label for="lastName">Nom</label>
                <input type="text" id="lastName" name="lastName">
            </div>
        </div>

        <div class="email-input">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="textarea">
            <label for="message">Message</label>
            <textarea id="message" name="message"></textarea>
        </div>

        <div class="btn-container">
            <button type="submit">Envoyer</button>
        </div>
    </form>

    <!-- Footer -->
    <?php
    include "../projet/partials/footer.php"
    ?>
</body>
<script src="/Projet-flash/assets/js/header.js"></script>

</html>