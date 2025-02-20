<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'ID de la commande est bien passé
if (!isset($_GET['commande_id'])) {
    die("ID de commande non spécifié.");
}

$commande_id = intval($_GET['commande_id']);

// Vérifier que la commande appartient à l'utilisateur et qu'elle est en attente
$stmt = $pdo->prepare("SELECT * FROM commandes WHERE id = ? AND utilisateur_id = ? AND statut = 'en attente'");
$stmt->execute([$commande_id, $_SESSION["user_id"]]);
$commande = $stmt->fetch();

if (!$commande) {
    die("Erreur : Commande introuvable ou non modifiable.");
}

// Supprimer la commande
$stmt = $pdo->prepare("DELETE FROM commandes WHERE id = ?");
$result = $stmt->execute([$commande_id]);

if (!$result) {
    die("Erreur SQL : " . implode(" - ", $stmt->errorInfo()));
} else {
    header("Location: ../views/dashboard-user.php?message=Commande supprimée avec succès");
    exit();
}
?>
