<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $type = $_POST["type"];
    
    // Vérifier que l'image a été envoyée
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $photo = $_FILES["photo"];
        $photoName = time() . "_" . basename($photo["name"]); // Éviter les doublons avec time()
        $photoPath = "../../public/uploads/" . $photoName;

        // Déplacer l'image uploadée
        if (move_uploaded_file($photo["tmp_name"], $photoPath)) {
            // Enregistrement en base de données
            $stmt = $pdo->prepare("INSERT INTO imprimantes (nom, type, photo) VALUES (?, ?, ?)");
            if ($stmt->execute([$nom, $type, $photoName])) {
                header("Location: ../views/dashboard-admin.php?message=Imprimante ajoutée");
                exit();
            } else {
                echo "Erreur lors de l'ajout.";
            }
        } else {
            echo "Erreur lors de l'upload du fichier.";
        }
    } else {
        echo "Aucune image envoyée.";
    }
}
?>
