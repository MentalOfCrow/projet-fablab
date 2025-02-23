<?php
session_start();
include '../db/config.php'; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_commande = $_POST["nom_commande"];
    $couleur = $_POST["couleur"];
    $type_impression = $_POST['type_impression']; 
    $hauteur = $_POST["hauteur"];
    $longueur = $_POST["longueur"];
    $largeur = $_POST["largeur"];
    $utilisateur_id = $_SESSION["user_id"]; 
    


    // 📂 Définir le bon chemin d'upload
    $upload_dir = __DIR__ . "/../../public/uploads/"; // 🔥 Assure-toi que ce dossier existe

    // Vérification du fichier STL
    if (isset($_FILES["fichier_stl"]) && $_FILES["fichier_stl"]["error"] == 0) {
        $file_name = time() . "_" . basename($_FILES["fichier_stl"]["name"]);
        $target_file = $upload_dir . $file_name; // 🔥 Correction du chemin absolu

        // ✅ Vérifier que le dossier existe, sinon le créer
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // 🔥 Création du dossier avec les bons droits
        }

        // ✅ Déplacement sécurisé du fichier
        if (move_uploaded_file($_FILES["fichier_stl"]["tmp_name"], $target_file)) {
            // Préparer la requête d'insertion
            $stmt = $pdo->prepare("INSERT INTO commandes (nom_commande, couleur, type_impression, hauteur, longueur, largeur, fichier_stl, utilisateur_id, statut, date_creation) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'en attente', NOW())");
            $result = $stmt->execute([$nom_commande, $couleur,$type_impression, $hauteur, $longueur, $largeur, $file_name, $utilisateur_id]);

            if ($result) {
                // Enregistrer la notification pour tous les administrateurs
                $commande_id = $pdo->lastInsertId(); // Récupérer l'ID de la dernière commande insérée
                $message = "Nouvelle commande : {$nom_commande} de {$utilisateur_id}";

                // Récupérer tous les administrateurs
                $stmtAdmins = $pdo->query("SELECT id FROM users WHERE role = 'admin'");
                $admins = $stmtAdmins->fetchAll();

                // Enregistrer la notification pour chaque administrateur
                foreach ($admins as $admin) {
                    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message, status, created_at) VALUES (?, ?, 'unread', NOW())");
                    $stmt->execute([$admin['id'], $message]); // 'unread' est la valeur correcte pour le statut
                }

                // Rediriger en fonction du rôle
                $redirect_page = ($_SESSION["role"] === "admin") ? "dashboard-admin.php" : "dashboard-user.php";
                header("Location: ../views/$redirect_page?message=Commande ajoutée avec succès");
                exit();
            } else {
                die("❌ Erreur SQL : " . implode(" - ", $stmt->errorInfo()));
            }
        } else {
            die("❌ Impossible de déplacer le fichier : " . $_FILES["fichier_stl"]["tmp_name"]);
        }
    } else {
        die("❌ Fichier STL invalide ou erreur d'upload.");
    }
}



// Récupérer l'ID des admins
$stmtAdmins = $pdo->query("SELECT id FROM users WHERE role = 'admin'");
$admins = $stmtAdmins->fetchAll();

$commande_id = $pdo->lastInsertId(); // ID de la commande insérée
$nom_commande = $_POST['nom_commande']; // Le nom de la commande
$message = "Nouvelle commande : {$nom_commande} a été ajoutée.";

// Insertion de la notification pour chaque admin
foreach ($admins as $admin) {
    $stmtNotification = $pdo->prepare("INSERT INTO notifications (user_id, message, status, created_at) VALUES (?, ?, 'unread', NOW())");
    $stmtNotification->execute([$admin['id'], $message]);
}
?>
