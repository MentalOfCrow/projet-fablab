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
    <link rel="stylesheet" href="/public/assets/css/modifier_commande.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>
<a href="/backend/views/historique.php" class="back-btn">Retour a mes commandes</a> 


<div class="commande-form-container">
    <h1>Modifier la commande : <?php echo htmlspecialchars($commande['nom_commande']); ?></h1>

    <form class="commande-form" action="../controllers/traiter_modification.php" method="POST">
        <label for="nom_commande">Nom de la commande :</label>
        <input type="text" id="nom_commande" name="nom_commande" value="<?php echo htmlspecialchars($commande['nom_commande']); ?>" required>

        <label for="couleur">Couleur :</label>
        <select id="couleur" name="couleur">
            <option value="Rouge" <?php if ($commande['couleur'] == 'Rouge') echo 'selected'; ?>>Rouge</option>
            <option value="Bleu" <?php if ($commande['couleur'] == 'Bleu') echo 'selected'; ?>>Bleu</option>
            <option value="Vert" <?php if ($commande['couleur'] == 'Vert') echo 'selected'; ?>>Vert</option>
            <option value="Jaune" <?php if ($commande['couleur'] == 'Jaune') echo 'selected'; ?>>Jaune</option>
            <option value="Noir" <?php if ($commande['couleur'] == 'Noir') echo 'selected'; ?>>Noir</option>
            <option value="Blanc" <?php if ($commande['couleur'] == 'Blanc') echo 'selected'; ?>>Blanc</option>
            <option value="Gris" <?php if ($commande['couleur'] == 'Gris') echo 'selected'; ?>>Gris</option>
            <option value="Orange" <?php if ($commande['couleur'] == 'Orange') echo 'selected'; ?>>Orange</option>
            <option value="Rose" <?php if ($commande['couleur'] == 'Rose') echo 'selected'; ?>>Rose</option>
            <option value="Violet" <?php if ($commande['couleur'] == 'Violet') echo 'selected'; ?>>Violet</option>
        </select>

        <label for="type_impression">Type d'impression :</label>
        <select id="type_impression" name="type_impression" required>
            <option value="résine">Résine</option>
            <option value="filament">Filament</option>
        </select>

        <label for="hauteur">Hauteur (mm) :</label>
        <input type="number" id="hauteur" name="hauteur" value="<?php echo htmlspecialchars($commande['hauteur']); ?>" step="0.1" required>

        <label for="longueur">Longueur (mm) :</label>
        <input type="number" id="longueur" name="longueur" value="<?php echo htmlspecialchars($commande['longueur']); ?>" step="0.1" required>

        <label for="largeur">Largeur (mm) :</label>
        <input type="number" id="largeur" name="largeur" value="<?php echo htmlspecialchars($commande['largeur']); ?>" step="0.1" required>

        <button type="submit" class="submit-button">Enregistrer les modifications</button>

        <input type="hidden" name="commande_id" value="<?php echo $commande['id']; ?>">
    </form>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
