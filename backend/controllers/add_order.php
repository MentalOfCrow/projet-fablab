<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utilisateur_id = $_SESSION["user_id"];
    $nom_commande = $_POST["nom_commande"];
    $couleur = $_POST["couleur"];
    $hauteur = $_POST["hauteur"];
    $longueur = $_POST["longueur"];
    $largeur = $_POST["largeur"];

    // Vérifier que le fichier STL est bien uploadé
    if (isset($_FILES["fichier_stl"]) && $_FILES["fichier_stl"]["error"] == 0) {
        $fichier = $_FILES["fichier_stl"];
        $fichierName = time() . "_" . basename($fichier["name"]);
        $fichierPath = "../../public/uploads/" . $fichierName;

        // Déplacer le fichier vers le dossier uploads
        if (move_uploaded_file($fichier["tmp_name"], $fichierPath)) {
            // Insérer la commande dans la base de données
            $stmt = $pdo->prepare("INSERT INTO commandes (utilisateur_id, nom_commande, couleur, hauteur, longueur, largeur, fichier_stl) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$utilisateur_id, $nom_commande, $couleur, $hauteur, $longueur, $largeur, $fichierName])) {
                header("Location: ../views/dashboard-admin.php?message=Commande ajoutée");
                exit();
            } else {
                echo "Erreur lors de l'ajout.";
            }
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    } else {
        echo "Aucun fichier STL envoyé.";
    }
}
?>
