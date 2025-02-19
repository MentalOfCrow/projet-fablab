<?php
session_start();
include '../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['printer_id']) && isset($_POST['etat'])) {
    $printer_id = $_POST['printer_id'];
    $etat = $_POST['etat'];

    // Mise à jour de l'état de l'imprimante
    $stmt = $pdo->prepare("UPDATE imprimantes SET etat = ? WHERE id = ?");
    if ($stmt->execute([$etat, $printer_id])) {
        $_SESSION['success'] = "État de l'imprimante mis à jour avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la mise à jour.";
    }

    header("Location: ../views/dashboard-admin.php");
    exit();
} else {
    $_SESSION['error'] = "Requête invalide.";
    header("Location: ../views/dashboard-admin.php");
    exit();
}
?>
