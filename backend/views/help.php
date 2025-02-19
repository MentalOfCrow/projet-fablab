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
    <title>Aide - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/help.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<!-- Bannière de la page Aide -->
<section class="help-banner">
    <div class="banner-content">
        <h1>Besoin d'Aide ?</h1>
        <p>Trouvez des réponses à vos questions et apprenez à utiliser la plateforme FabLab efficacement.</p>
    </div>
</section>

<!-- Contenu principal -->
<main class="help-container">
    <h2 class="help-title">Guide d'utilisation</h2>
    
    <div class="help-section">
        <h3>🚀 Comment passer une commande d'impression 3D ?</h3>
        <p>Accédez à votre tableau de bord, téléchargez votre fichier STL, choisissez les options d'impression et validez votre commande.</p>
    </div>

    <div class="help-section">
        <h3>🖨️ Suivi de votre impression</h3>
        <p>Consultez l'état de votre commande en temps réel depuis la section <strong>"Mes Commandes"</strong>. Vous recevrez une notification dès qu'elle est prête.</p>
    </div>

    <div class="help-section">
        <h3>📦 Retrait de votre impression</h3>
        <p>Une fois terminée, récupérez votre impression au FabLab. Un email de confirmation vous sera envoyé.</p>
    </div>

    <div class="help-section">
        <h3>⚠️ Annulation d'une commande</h3>
        <p>Vous pouvez annuler une commande avant qu'elle ne soit lancée en impression. Une fois en cours, l'annulation n'est plus possible.</p>
    </div>

    <div class="help-section">
        <h3>📞 Besoin d'une assistance ?</h3>
        <p>Contactez-nous par email à <a href="mailto:support@fablab.com">support@fablab.com</a> ou par téléphone au +33 4 84 25 24 10.</p>
    </div>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
