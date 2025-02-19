<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/login.php");
    exit();
}

// Vérifier que le formulaire a bien été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commande_id = $_POST["commande_id"];
    $nom_commande = trim($_POST["nom_commande"]);
    $couleur = $_POST["couleur"];
    $hauteur = $_POST["hauteur"];
    $longueur = $_POST["longueur"];
    $largeur = $_POST["largeur"];

    // Vérifier si la commande appartient bien à l'utilisateur et qu'elle est encore en attente
    $stmt = $pdo->prepare("SELECT id FROM commandes WHERE id = ? AND utilisateur_id = ? AND statut = 'en attente'");
    $stmt->execute([$commande_id, $_SESSION["user_id"]]);

    if ($stmt->rowCount() === 0) {
        header("Location: ../views/dashboard-user.php?error=Modification impossible, commande non en attente.");
        exit();
    }

    // Mise à jour de la commande
    $stmt = $pdo->prepare("UPDATE commandes SET nom_commande = ?, couleur = ?, hauteur = ?, longueur = ?, largeur = ? WHERE id = ?");
    if ($stmt->execute([$nom_commande, $couleur, $hauteur, $longueur, $largeur, $commande_id])) {
        header("Location: ../views/dashboard-user.php?message=Modification réussie");
        exit();
    } else {
        header("Location: ../views/modifier_commande.php?commande_id=$commande_id&error=Erreur lors de la modification");
        exit();
    }
} else {
    header("Location: ../views/dashboard-user.php");
    exit();
}
?>
