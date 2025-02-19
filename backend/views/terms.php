<?php
// Vérifier si la session est déjà active avant de l'initialiser
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditions Générales d'Utilisation - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/terms.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<!-- Bannière -->
<section class="terms-banner">
    <div class="banner-content">
        <h1>Conditions Générales d'Utilisation</h1>
        <p>Veuillez lire attentivement nos conditions d'utilisation avant d'utiliser notre plateforme.</p>
    </div>
</section>

<!-- Contenu Principal -->
<main class="terms-container">
    <section class="terms-section">
        <h2>1. Introduction</h2>
        <p>Bienvenue sur FabLab. En utilisant notre site et nos services, vous acceptez ces Conditions Générales d'Utilisation.</p>
    </section>

    <section class="terms-section">
        <h2>2. Accès et Utilisation du Service</h2>
        <p>Notre plateforme est accessible à tous les utilisateurs respectant nos règles. Vous êtes responsables des informations fournies et de leur exactitude.</p>
    </section>

    <section class="terms-section">
        <h2>3. Droits et Responsabilités</h2>
        <p>Vous acceptez de ne pas utiliser nos services à des fins frauduleuses. Toute infraction peut entraîner une suspension ou une suppression de votre compte.</p>
    </section>

    <section class="terms-section">
        <h2>4. Protection des Données</h2>
        <p>Nous collectons et traitons vos données conformément à notre <a href="/backend/views/privacy.php">Politique de Confidentialité</a>
            Politique de Confidentialité</a>
        Politique de Confidentialité</a>.</p>
    </section>

    <section class="terms-section">
        <h2>5. Modification des Conditions</h2>
        <p>FabLab se réserve le droit de modifier ces conditions à tout moment. Vous serez informé des changements importants.</p>
    </section>

    <section class="terms-section">
        <h2>6. Contact</h2>
        <p>Pour toute question relative aux conditions générales, contactez-nous à <a href="mailto:contact@fablab.com">contact@fablab.com</a>.</p>
    </section>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
