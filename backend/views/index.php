<?php
// Démarrer la session si besoin
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FabLab - Gestion des impressions 3D</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/index.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container">

    <!-- CONTENU PRINCIPAL -->
    <main class="content">
        <section class="home-section-1">
            <div class="left-container">
                <h1>Bienvenue sur la plateforme de gestion du FabLab</h1>
                <p>Optimisez la gestion des impressions 3D en automatisant les commandes et en suivant l’état des imprimantes.</p>
                
                <h2>📌 Conception du projet</h2>
                <p>Ce projet a été conçu pour moderniser et faciliter la gestion des impressions 3D au sein d’un FabLab. Traditionnellement, la gestion se faisait manuellement via des fichiers Excel, rendant le suivi complexe et sujet aux erreurs.</p>
                <p>Notre plateforme numérique permet une gestion centralisée et intuitive, où les utilisateurs peuvent passer des commandes, suivre leurs impressions en temps réel et optimiser l'utilisation des imprimantes disponibles.</p>

                <h2>🔍 Objectifs du projet</h2>
                <ul>
                    <li>💡 Automatiser le processus de gestion des commandes d’impression 3D.</li>
                    <li>📊 Offrir une meilleure visibilité sur l’état des imprimantes et des impressions.</li>
                    <li>⚙️ Permettre une planification automatique des impressions en fonction des ressources disponibles.</li>
                    <li>🔔 Intégrer un système de notifications pour alerter les utilisateurs de l’avancement de leurs commandes.</li>
                    <li>📂 Faciliter l’exportation des statistiques et rapports d’utilisation.</li>
                </ul>
            </div>
            <div class="carousel">
                <img class="carousel-image" src="/public/assets/images/imprimante1.jpg" alt="Imprimante 3D 1">
                <img class="carousel-image" src="/public/assets/images/imprimante2.jpg" alt="Imprimante 3D 2">
                <img class="carousel-image" src="/public/assets/images/imprimante3.jpg" alt="Imprimante 3D 3">
            </div>
        </section>

        <section class="home-section-2">
            <div class="features-container">
                <p class="title">🚀 Grâce à notre solution, vous pouvez :</p>
                <ul class="features-list">
                    <li>📝 Créer et modifier vos commandes d'impression facilement via une interface simplifiée.</li>
                    <li>📡 Suivre en temps réel l’état de vos impressions et la disponibilité des imprimantes.</li>
                    <li>🖨️ Planifier automatiquement vos impressions en fonction des ressources disponibles.</li>
                    <li>📈 Visualiser vos statistiques d'utilisation et générer des rapports exportables.</li>
                    <li>🔔 Recevoir des notifications pour être informé de l’état de vos commandes.</li>
                </ul>
                <p class="final-text">Notre plateforme intuitive vous permet de gérer vos impressions de manière efficace et d’optimiser l’utilisation des imprimantes 3D du FabLab.</p>
            </div>
        </section>
    </main>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

<script src="/public/js/app.js"></script>
</body>
</html>
