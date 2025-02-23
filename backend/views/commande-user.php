<?php
include '../db/config.php';

session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
    header("Location: ../views/login.php");
    exit();
}

// Récupérer les infos de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT fullname FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/commande.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-user.php" class="back-btn">Retour au Dashboard</a> 
  
    <div class="container">
        <div id="commande">
            <h2>Passer une commande</h2>

            <form action="../controllers/add_order.php" method="POST" enctype="multipart/form-data" class="add-order-form">
                <label for="nom_commande">Nom de la commande :</label>
                <input type="text" id="nom_commande" name="nom_commande" required>

                <label for="couleur">Couleur :</label>
                <select id="couleur" name="couleur" required>
                    <option value="Rouge">Rouge</option>
                    <option value="Bleu">Bleu</option>
                    <option value="Vert">Vert</option>
                    <option value="Jaune">Jaune</option>
                    <option value="Noir">Noir</option>
                    <option value="Blanc">Blanc</option>
                    <option value="Gris">Gris</option>
                    <option value="Orange">Orange</option>
                    <option value="Rose">Rose</option>
                    <option value="Violet">Violet</option>
                </select>

                <label for="type_impression">Type d'impression :</label>
                <select id="type_impression" name="type_impression" required>
                    <option value="résine">Résine</option>
                    <option value="filament">Filament</option>
                </select>

                <label for="hauteur">Hauteur (mm) :</label>
                <input type="number" id="hauteur" name="hauteur" step="0.1" required>

                <label for="longueur">Longueur (mm) :</label>
                <input type="number" id="longueur" name="longueur" step="0.1" required>

                <label for="largeur">Largeur (mm) :</label>
                <input type="number" id="largeur" name="largeur" step="0.1" required>

                <label for="fichier_stl">Fichier STL :</label>
                <input type="file" id="fichier_stl" name="fichier_stl" accept=".stl" required>

                <button type="submit">Passer la commande</button>
            </form>
        </div>
    </div>     


<?php include '../../backend/includes/footer.php'; ?>

</body>
</html>
