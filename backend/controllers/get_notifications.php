<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION["user_id"])) {
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer les commandes terminées non encore notifiées
$stmt = $pdo->prepare("
    SELECT id, nom_commande FROM commandes 
    WHERE utilisateur_id = ? AND statut = 'terminé' AND notification_envoyee = 0
");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll();

if (!empty($notifications)) {
    foreach ($notifications as $notif) {
        echo "<div class='notification'>✅ Votre impression '{$notif['nom_commande']}' est terminée !</div>";
    }

    // Marquer les notifications comme envoyées
    $updateStmt = $pdo->prepare("
        UPDATE commandes SET notification_envoyee = 1 
        WHERE utilisateur_id = ? AND statut = 'terminé'
    ");
    $updateStmt->execute([$user_id]);
}
?>
