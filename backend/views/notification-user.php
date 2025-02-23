<?php
include '../db/config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
    header("Location: ../views/login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION["user_id"];

// Récupérer les notifications non lues
$stmtUnread = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? AND status = 'unread' ORDER BY created_at DESC");
$stmtUnread->execute([$user_id]);
$notificationsUnread = $stmtUnread->fetchAll();

// Récupérer les notifications lues
$stmtRead = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? AND status = 'read' ORDER BY created_at DESC");
$stmtRead->execute([$user_id]);
$notificationsRead = $stmtRead->fetchAll();

// Récupérer le nombre de notifications non lues
$stmtUnreadCount = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND status = 'unread'");
$stmtUnreadCount->execute([$user_id]);
$unreadCount = $stmtUnreadCount->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Notifications</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/notification.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-user.php" class="back-btn">Retour au Dashboard</a> 

<div class="container">
    <div id="notification">
        <h2>Mes notifications</h2>

        <div id="notification-box">
            <h3>Notifications non lues</h3>
            <ul id="notifications-list">
                <?php 
                if (empty($notificationsUnread)) {
                    echo "<p>Aucune notification non lue à afficher.</p>";
                } else {
                    foreach ($notificationsUnread as $notification) { ?>
                        <li>
                            <p><strong>Notification :</strong> <?php echo $notification['message']; ?></p>
                            <p><strong>Date :</strong> <?php echo date("d/m/Y H:i", strtotime($notification['created_at'])); ?></p>
                            <a href="notification-user.php?notification_id=<?php echo $notification['id']; ?>">Marquer comme lue</a>
                        </li>
                    <?php }
                }
                ?>
            </ul>

            <h3>Notifications lues</h3>
            <ul id="notifications-list">
                <?php 
                if (empty($notificationsRead)) {
                    echo "<p>Aucune notification lue à afficher.</p>";
                } else {
                    foreach ($notificationsRead as $notification) { ?>
                        <li>
                            <p><strong>Notification :</strong> <?php echo $notification['message']; ?></p>
                            <p><strong>Date :</strong> <?php echo date("d/m/Y H:i", strtotime($notification['created_at'])); ?></p>
                        </li>
                    <?php }
                }
                ?>
            </ul>
        </div> 
    </div>
</div> 

<?php include '../../backend/includes/footer.php'; ?>

<script src="/public/js/notification.js"></script>

</body>
</html>
