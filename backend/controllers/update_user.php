<?php
session_start();
include '../db/config.php';

// Vérifier si l'admin est connecté
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

// Vérifier si les données POST existent
if (isset($_POST["user_id"]) && isset($_POST["role"])) {
    $user_id = $_POST["user_id"];
    $new_role = $_POST["role"];

    // Sécuriser la requête SQL
    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
    if ($stmt->execute([$new_role, $user_id])) {
        header("Location: ../views/dashboard-admin.php?message=Rôle mis à jour");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }
} else {
    echo "Données invalides.";
}
?>
