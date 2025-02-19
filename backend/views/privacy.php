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
    <title>Politique de Confidentialité - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/privacy.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<!-- Bannière -->
<section class="privacy-banner">
    <div class="banner-content">
        <h1>Politique de Confidentialité</h1>
        <p>Découvrez comment nous collectons, utilisons et protégeons vos données.</p>
    </div>
</section>

<!-- Contenu Principal -->
<main class="privacy-container">
    <section class="privacy-section">
        <h2>1. Introduction</h2>
        <p>Nous nous engageons à protéger la confidentialité de vos informations personnelles et à les traiter en toute transparence.</p>
    </section>

    <section class="privacy-section">
        <h2>2. Informations Collectées</h2>
        <p>Nous collectons différentes catégories de données, notamment :</p>
        <ul>
            <li>Nom et prénom</li>
            <li>Adresse e-mail</li>
            <li>Données de navigation</li>
            <li>Historique des commandes et interactions</li>
        </ul>
    </section>

    <section class="privacy-section">
        <h2>3. Utilisation des Données</h2>
        <p>Les informations collectées sont utilisées pour :</p>
        <ul>
            <li>Fournir et améliorer nos services</li>
            <li>Personnaliser votre expérience utilisateur</li>
            <li>Gérer vos commandes et votre compte</li>
            <li>Assurer la sécurité de la plateforme</li>
        </ul>
    </section>

    <section class="privacy-section">
        <h2>4. Partage des Données</h2>
        <p>Nous ne partageons pas vos données personnelles avec des tiers, sauf dans les cas suivants :</p>
        <ul>
            <li>Conformité aux obligations légales</li>
            <li>Services tiers nécessaires à l'exploitation du site</li>
        </ul>
    </section>

    <section class="privacy-section">
        <h2>5. Sécurité des Données</h2>
        <p>Nous mettons en place des mesures de sécurité avancées pour protéger vos informations contre tout accès non autorisé.</p>
    </section>

    <section class="privacy-section">
        <h2>6. Vos Droits</h2>
        <p>Vous avez le droit de :</p>
        <ul>
            <li>Accéder à vos données</li>
            <li>Les rectifier ou les supprimer</li>
            <li>Limiter leur traitement</li>
            <li>Vous opposer à leur utilisation</li>
        </ul>
    </section>

    <section class="privacy-section">
        <h2>7. Contact</h2>
        <p>Pour toute question relative à notre politique de confidentialité, contactez-nous à : 
            <a href="mailto:contact@fablab.com">contact@fablab.com</a>
        </p>
    </section>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
