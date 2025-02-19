<?php
// Vérifier si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/about.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<!-- Bannière -->
<section class="about-banner">
    <h1>Bienvenue au FabLab</h1>
    <p>Un espace innovant pour la fabrication numérique et l'impression 3D.</p>
</section>

<!-- Contenu principal -->
<main class="about-container">
    <section class="about-intro">
        <h2>Notre Mission</h2>
        <p>Le FabLab est une plateforme qui optimise la gestion des impressions 3D et favorise l'innovation.</p>
    </section>

    <!-- Valeurs -->
    <section class="values">
        <h2>Nos Valeurs</h2>
        <div class="value-cards">
            <div class="value-card">
                <span>🚀</span>
                <h3>Innovation</h3>
                <p>Encourager la créativité en explorant les nouvelles technologies.</p>
            </div>
            <div class="value-card">
                <span>🤝</span>
                <h3>Collaboration</h3>
                <p>Favoriser l'échange de compétences entre passionnés et experts.</p>
            </div>
            <div class="value-card">
                <span>🌍</span>
                <h3>Accessibilité</h3>
                <p>Rendre l'impression 3D accessible à tous, quel que soit le niveau.</p>
            </div>
        </div>
    </section>

    <!-- Équipe -->
    <section class="team">
        <h2>Notre Équipe</h2>
        <div class="team-members">
            <div class="member">
                <img src="/public/assets/images/team1.jpg" alt="Jean Dupont">
                <h3>Jean Dupont</h3>
                <p>CEO & Fondateur</p>
            </div>
            <div class="member">
                <img src="/public/assets/images/team2.jpg" alt="Marie Curie">
                <h3>Marie Curie</h3>
                <p>Directrice Technique</p>
            </div>
            <div class="member">
                <img src="/public/assets/images/team3.jpg" alt="Albert Einstein">
                <h3>Albert Einstein</h3>
                <p>Expert Impression 3D</p>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="contact">
        <h2>Contactez-nous</h2>
        <p>📧 Email : <a href="mailto:contact@fablab.com">contact@fablab.com</a></p>
        <p>📞 Téléphone : +33 4 84 25 24 10</p>
    </section>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
