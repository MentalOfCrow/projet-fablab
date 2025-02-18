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
</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <!-- Logo -->
                <a href="/backend/views/index.php" class="logo">
                    <img src="/public/assets/images/logo-FabLab.png" alt="FabLab Logo">
                </a>
                
                <!-- Bouton Connexion / Déconnexion -->
                <div class="auth-btn">
                    <?php if (isset($_SESSION["user_id"])): ?>
                        <a href="/backend/views/logout.php" class="logout-btn">Déconnexion</a>
                    <?php else: ?>
                        <a href="/backend/views/login.php" class="login-btn">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <main>
