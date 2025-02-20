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

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Afficher le bouton Connexion si l'utilisateur n'est pas connecté -->
                    <div class="connexion-btn">
                        <a href="/backend/views/login.php">Connexion</a>
                    </div>
                <?php else: ?>
                    <!-- Afficher les boutons dynamiques si l'utilisateur est connecté -->
                    <div class="user-buttons">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <!-- Boutons pour l'admin -->
                            <a href="/backend/views/commande.php">Passer une commande</a>
                            <a href="/backend/views/attentes.php">Impressions en attente</a>
                            <a href="/backend/views/cours.php">Impressions en cours</a>
                            <a href="/backend/views/terminees.php">Impressions terminées</a>
                            <a href="/backend/views/imprimantes.php">Liste des imprimantes</a>
                            <a href="/backend/views/gestion.php">Gestion des utilisateurs</a>
                            <a href="/backend/views/export.php">Exporter les données</a>
                            <a href="/backend/controllers/logout.php">Déconnexion</a>
                        <?php elseif ($_SESSION['role'] === 'user'): ?>
                            <!-- Boutons pour l'utilisateur -->
                            <a href="/backend/views/commande-user.php">Passer une commande</a>
                            <a href="/backend/views/historique.php">Historique des commandes</a>
                            <a href="/backend/views/modifier_profil.php">Modifier mon profil</a>
                            <a href="/backend/controllers/logout.php">Déconnexion</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>
