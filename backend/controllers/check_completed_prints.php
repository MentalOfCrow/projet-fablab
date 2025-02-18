<?php
include '../db/config.php';

// Sélectionner les impressions terminées
$stmt = $pdo->query("
    SELECT id, imprimante_id, duree, heure_debut 
    FROM commandes 
    WHERE statut = 'en cours'
");

while ($row = $stmt->fetch()) {
    $heure_debut = strtotime($row['heure_debut']);
    $heure_fin = $heure_debut + ($row['duree'] * 60);
    
    // Vérifier si l'impression est terminée
    if (time() >= $heure_fin) {
        $commande_id = $row['id'];
        $imprimante_id = $row['imprimante_id'];

        // Mettre à jour la commande comme "terminée"
        $stmtUpdate = $pdo->prepare("UPDATE commandes SET statut = 'terminé' WHERE id = ?");
        $stmtUpdate->execute([$commande_id]);

        // Mettre à jour l'imprimante comme "libre"
        $stmtUpdatePrinter = $pdo->prepare("UPDATE imprimantes SET etat = 'libre' WHERE id = ?");
        $stmtUpdatePrinter->execute([$imprimante_id]);
    }
}
?>
