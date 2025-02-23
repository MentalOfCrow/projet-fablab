<?php
include '../db/config.php';

// Vérifier que la requête provient de l'administrateur et que la commande a bien été passée
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commande_id'])) {
    $commande_id = $_POST['commande_id'];

    // Récupérer les informations de la commande
    $stmt = $pdo->prepare("SELECT commandes.nom_commande, users.fullname, commandes.utilisateur_id FROM commandes JOIN users ON commandes.utilisateur_id = users.id WHERE commandes.id = ?");
    $stmt->execute([$commande_id]);
    $commande = $stmt->fetch();

    // Créer le message de la notification
    $message = "Nouvelle commande : {$commande['nom_commande']} de {$commande['fullname']}";
    $status = 'unread';  // Statut par défaut
    $created_at = date('Y-m-d H:i:s');
    
    // Récupérer tous les administrateurs sauf l'utilisateur ayant créé la commande
    $stmtAdmins = $pdo->prepare("SELECT id FROM users WHERE role = 'admin' AND id != ?");
    $stmtAdmins->execute([$commande['utilisateur_id']]); // Exclure l'utilisateur ayant créé la commande
    $admins = $stmtAdmins->fetchAll();

    // Enregistrer la notification pour chaque administrateur
    foreach ($admins as $admin) {
        $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message, status, created_at) VALUES (?, ?, ?, ?)");
        $stmt->execute([$admin['id'], $message, $status, $created_at]);
    }

    echo "Notification envoyée avec succès à tous les administrateurs sauf l'utilisateur créateur de la commande.";
}
?>
