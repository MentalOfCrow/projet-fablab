<?php
// Vérifier si la session est active avant de la démarrer
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/contact.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<!-- Bannière -->
<section class="contact-banner">
    <div class="banner-content">
        <h1>Contactez-nous</h1>
        <p>Nous sommes là pour répondre à toutes vos questions et vous accompagner.</p>
    </div>
</section>

<!-- Contenu Principal -->
<main class="contact-container">
    <section class="contact-info">
        <h2>Informations de Contact</h2>
        <p><i class="fas fa-envelope"></i> Email : <a href="mailto:contact@fablab.com">contact@fablab.com</a></p>
        <p><i class="fas fa-phone"></i> Téléphone : +33 4 84 25 24 10</p>
        <p><i class="fas fa-map-marker-alt"></i> Adresse : 2 Rue de la Fourane Aix-En-Provence France</p>
    </section>

    <section class="contact-form">
        <h2>Envoyez-nous un message</h2>
        <form action="/backend/controllers/send_message.php" method="POST">
            <div class="form-group">
                <label for="name">Nom complet :</label>
                <input type="text" id="name" name="name" required placeholder="Votre nom">
            </div>
            
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required placeholder="Votre email">
            </div>
            
            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required placeholder="Votre message..."></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </section>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
