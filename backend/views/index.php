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
<?php include '../../backend/includes/header.php'; ?>
    <!-- CONTENU PRINCIPAL -->
    <main>
        <section class="home">
            <h1>Bienvenue sur la plateforme de gestion du FabLab</h1>
            <p>Optimisez la gestion des impressions 3D en automatisant les commandes et en suivant l’état des imprimantes.</p>
            
            
        </section>
    </main>
    <?php include '../../backend/includes/footer.php'; ?>
</body>
</html>
