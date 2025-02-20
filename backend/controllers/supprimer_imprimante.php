<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté et qu'il est autorisé à supprimer une imprimante
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Vérifier que l'ID de l'imprimante est bien passé
if (!isset($_POST['printer_id'])) {
    die("ID de l'imprimante non spécifié.");
}

$printer_id = intval($_POST['printer_id']);

// Vérifier que l'imprimante existe dans la base de données
$stmt = $pdo->prepare("SELECT * FROM imprimantes WHERE id = ?");
$stmt->execute([$printer_id]);
$printer = $stmt->fetch();

if (!$printer) {
    die("Imprimante introuvable.");
}

// Supprimer l'imprimante de la base de données
$stmt = $pdo->prepare("DELETE FROM imprimantes WHERE id = ?");
$result = $stmt->execute([$printer_id]);

if (!$result) {
    die("Erreur lors de la suppression de l'imprimante.");
} else {
    header("Location: /backend/views/dashboard-admin.php?message=Imprimante supprimée avec succès");
    exit();
}
?>
