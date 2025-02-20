<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté et autorisé à supprimer
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Vérifier que l'ID de l'utilisateur est bien passé
if (!isset($_POST['user_id'])) {
    die("ID de l'utilisateur non spécifié.");
}

$user_id = intval($_POST['user_id']);

// Empêcher la suppression de l'utilisateur administrateur principal
if ($user_id == 1) {
    die("Vous ne pouvez pas supprimer l'administrateur principal.");
}

// Vérifier si l'utilisateur existe dans la base de données
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    die("Utilisateur introuvable.");
}

// Supprimer l'utilisateur de la base de données
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$result = $stmt->execute([$user_id]);

if (!$result) {
    die("Erreur lors de la suppression de l'utilisateur.");
} else {
    // Rediriger vers la page de gestion des utilisateurs avec un message de confirmation
    header("Location: /backend/views/dashboard-admin.php?message=Utilisateur supprimé avec succès");
    exit();
}
?>
