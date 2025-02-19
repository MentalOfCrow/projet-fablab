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
            </div>
            <div class="right-container">
                <img src="/public/assets/images/lab.jpg" alt="Le FabLab" class="fablab-image">
            </div>
        </section>

        <section class="home-section-2">
            <div class="features-container">
                <p class="title">Grâce à notre solution, vous pouvez :</p>
                <ul class="features-list">
                    <li>Créer et modifier vos commandes d'impression facilement.</li>
                    <li>Suivre en temps réel l’état de vos impressions et la disponibilité des imprimantes.</li>
                    <li>Planifier automatiquement vos impressions en fonction des ressources disponibles.</li>
                    <li>Visualiser vos statistiques d'utilisation et générer des rapports exportables.</li>
                    <li>Recevoir des notifications pour être informé de l’état de vos commandes.</li>
                </ul>
                <p class="final-text">Notre plateforme intuitive vous permet de gérer vos impressions de manière efficace et d’optimiser l’utilisation des imprimantes 3D du FabLab.</p>
            </div>
        </section>
    </main>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
