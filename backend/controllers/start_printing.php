<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

// Vérifier si les données sont valides
if (isset($_POST["commande_id"]) && isset($_POST["imprimante_id"]) && isset($_POST["duree"])) {
    $commande_id = $_POST["commande_id"];
    $imprimante_id = $_POST["imprimante_id"];
    $duree = $_POST["duree"];

    // Mettre à jour le statut de la commande et ajouter la durée
    $stmt = $pdo->prepare("UPDATE commandes SET statut = 'en cours', imprimante_id = ?, duree = ?, heure_debut = NOW() WHERE id = ?");
    if ($stmt->execute([$imprimante_id, $duree, $commande_id])) {

        // Mettre à jour l'imprimante comme "en impression"
        $stmtImprimante = $pdo->prepare("UPDATE imprimantes SET etat = 'en impression' WHERE id = ?");
        $stmtImprimante->execute([$imprimante_id]);

        header("Location: ../views/dashboard-admin.php?message=Impression lancée");
        exit();
    } else {
        echo "Erreur lors du lancement de l'impression.";
    }
} else {
    echo "Données invalides.";
}
?>
