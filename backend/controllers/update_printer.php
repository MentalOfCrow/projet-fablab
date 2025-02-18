<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

// Vérifier si les données sont valides
if (isset($_POST["printer_id"]) && isset($_POST["etat"])) {
    $printer_id = $_POST["printer_id"];
    $etat = $_POST["etat"];

    $stmt = $pdo->prepare("UPDATE imprimantes SET etat = ? WHERE id = ?");
    if ($stmt->execute([$etat, $printer_id])) {
        header("Location: ../views/dashboard-admin.php?message=État mis à jour");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }
} else {
    echo "Données invalides.";
}
?>
