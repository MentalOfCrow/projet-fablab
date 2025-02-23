<?php
session_start();
include '../db/config.php';

// Vérification si l'utilisateur est connecté et s'il a bien un rôle admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../views/login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION["user_id"];

// Vérification si l'ID est valide
if (!is_numeric($user_id)) {
    die("Erreur : L'ID de l'utilisateur est invalide.");
}

// Requête pour récupérer le nom de l'utilisateur
$stmt = $pdo->prepare("SELECT fullname FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($user) {
    $fullname = $user['fullname'];  // Nom de l'utilisateur connecté
} else {
    die("Utilisateur introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>

<div class="dashboard-container">
<h1>Bienvenue sur votre espace de gestion, <?php echo htmlspecialchars($fullname); ?> 👋</h1>
    <p>
        Vous êtes connecté en tant qu’administrateur. Cet espace vous permet de gérer efficacement les commandes d’impression 3D,
        d’administrer les imprimantes, de suivre l’état des impressions et d’accéder aux statistiques de production.
    </p>

    <section class="dashboard-section">
    <h2>🔹 Gestion des impressions & commandes</h2>
    <p>Visualisez, suivez et mettez à jour l’état des impressions en cours. Consultez les commandes en attente, assignez-les aux imprimantes disponibles et accédez à l’historique.</p>
</section>

<section class="dashboard-section">
    <h2>🔹 Administration des imprimantes</h2>
    <p>Surveillez l’état des imprimantes, assurez leur bon fonctionnement et optimisez leur utilisation. Mettez en maintenance les machines et gérez leur disponibilité.</p>
</section>


    <section class="dashboard-section">
        <h2>🔹 Statistiques et rapports</h2>
        <p>Obtenez un aperçu de l’activité du FabLab : nombre d’impressions réalisées, temps moyen d’impression, taux d’utilisation des imprimantes, et bien plus encore.</p>
    </section>

    <section class="dashboard-section">
        <h2>🔹 Notifications et alertes</h2>
        <p>Recevez des notifications sur l’état des impressions, les machines nécessitant une maintenance et les nouvelles commandes soumises.</p>
    </section>
</div>

<?php include '../../backend/includes/footer.php'; ?>

</body>
</html>
