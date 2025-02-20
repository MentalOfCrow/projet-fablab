<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/login.php");
    exit();
}

// Vérifier si les champs sont bien envoyés
if (!isset($_POST['commande_id'], $_POST['nom_commande'], $_POST['couleur'], $_POST['hauteur'], $_POST['longueur'], $_POST['largeur'])) {
    die("Tous les champs sont requis.");
}

// Récupérer les données
$commande_id = intval($_POST['commande_id']);
$nom_commande = trim($_POST['nom_commande']);
$couleur = trim($_POST['couleur']);
$hauteur = floatval($_POST['hauteur']);
$longueur = floatval($_POST['longueur']);
$largeur = floatval($_POST['largeur']);

// Vérification de la validité des valeurs
if (empty($nom_commande) || !in_array($couleur, ['Rouge', 'Bleu', 'Vert', 'Jaune', 'Noir', 'Blanc', 'Gris','Orange','Rose','Violet',])) {
    die("Des erreurs dans les données soumises.");
}

// Vérifier que la commande appartient à l'utilisateur et est bien en attente
$stmt = $pdo->prepare("SELECT * FROM commandes WHERE id = ? AND utilisateur_id = ? AND statut = 'en attente'");
$stmt->execute([$commande_id, $_SESSION["user_id"]]);
$commande = $stmt->fetch();

if (!$commande) {
    die("Erreur : Commande introuvable ou non modifiable.");
}

// Mettre à jour la commande
$stmt = $pdo->prepare("
    UPDATE commandes 
    SET nom_commande = ?, couleur = ?, hauteur = ?, longueur = ?, largeur = ? 
    WHERE id = ?
");

$result = $stmt->execute([$nom_commande, $couleur, $hauteur, $longueur, $largeur, $commande_id]);

if (!$result) {
    die("Erreur SQL : " . implode(" - ", $stmt->errorInfo()));
} else {
    header("Location: ../views/dashboard-user.php?message=Commande modifiée avec succès");
    exit();
}
?>
