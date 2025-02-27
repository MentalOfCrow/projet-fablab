<?php
include __DIR__ . '/../db/config.php';

// Vérifier si l'utilisateur est connecté avant d'essayer d'accéder à ses informations
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // Récupérer le nombre de notifications non lues pour l'administrateur connecté
    $stmtUnreadCount = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND status = 'unread'");
    $stmtUnreadCount->execute([$user_id]);
    $unreadCount = $stmtUnreadCount->fetchColumn();
} else {
    // Si l'utilisateur n'est pas connecté, ne pas tenter d'utiliser $_SESSION["user_id"]
    $unreadCount = 0;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <!-- Logo -->
                <a href="/backend/views/index.php" class="logo">
                    <img src="/public/assets/images/logo-FabLab.png" alt="FabLab Logo">
                </a>

                <div class="nav-links">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <!-- Afficher le bouton Connexion si l'utilisateur n'est pas connecté -->
                        <a href="/backend/views/login.php">Connexion</a>
                    <?php else: ?>
                        <!-- Afficher les boutons dynamiques si l'utilisateur est connecté -->
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <!-- Boutons pour l'admin -->
                            <a href="/backend/views/notification-admin.php">
                                <!-- Icône de notification -->
                                <i class="fas fa-bell"></i>

                                <?php if ($unreadCount > 0) { ?>
                                    <!-- Pastille rouge si des notifications non lues -->
                                    <span class="notification-badge"><?php echo $unreadCount; ?></span>
                                <?php } ?>
                            </a>
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
                            <a href="/backend/views/historique.php">Mes commandes</a>
                            <a href="/backend/views/modifier_profil.php">Mon profil</a>
                            <a href="/backend/controllers/logout.php">Déconnexion</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
