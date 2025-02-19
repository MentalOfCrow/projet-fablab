<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de la commande
if (!isset($_GET['commande_id'])) {
    die("ID de commande non spécifié.");
}

$commande_id = $_GET['commande_id'];

// Vérifier que la commande appartient bien à l'utilisateur et qu'elle est modifiable
$stmt = $pdo->prepare("SELECT * FROM commandes WHERE id = ? AND utilisateur_id = ? AND statut = 'en attente'");
$stmt->execute([$commande_id, $_SESSION["user_id"]]);
$commande = $stmt->fetch();

if (!$commande) {
    die("Commande introuvable ou non modifiable.");
}

// Formulaire de modification
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier commande</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="commande-form-container">
    <h1>Modifier la commande : <?php echo htmlspecialchars($commande['nom_commande']); ?></h1>

    <form class="commande-form" action="traiter_modification.php" method="POST">
        <label for="nom_commande">Nom de la commande :</label>
        <input type="text" id="nom_commande" name="nom_commande" value="dino 7" required>

        <label for="couleur">Couleur :</label>
        <select id="couleur" name="couleur">
            <option value="Rouge" selected>Rouge</option>
            <option value="Bleu">Bleu</option>
            <option value="Vert">Vert</option>
        </select>

        <label for="hauteur">Hauteur (mm) :</label>
        <input type="number" id="hauteur" name="hauteur" value="100.00" step="0.1" required>

        <label for="longueur">Longueur (mm) :</label>
        <input type="number" id="longueur" name="longueur" value="50.00" step="0.1" required>

        <label for="largeur">Largeur (mm) :</label>
        <input type="number" id="largeur" name="largeur" value="50.00" step="0.1" required>

        <button type="submit" class="submit-button">Enregistrer les modifications</button>
        <a href="dashboard-user.php" class="cancel-link">Annuler</a>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
