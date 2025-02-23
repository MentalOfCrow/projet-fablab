<?php
session_start();
include '../db/config.php';

// Vérification si l'utilisateur est connecté et s'il a bien un rôle user
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
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
    <title>Dashboard Utilisateur - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>

<div class="dashboard-container">
    <h1>Bienvenue, <?php echo htmlspecialchars($fullname); ?> 👋</h1>
    <p>Gérez vos commandes et suivez vos impressions ici.</p>

    <section class="dashboard-section">
        <h2>🛠️ Suivi des impressions</h2>
        <p>Consultez l’état de vos impressions en cours et l’historique des commandes.</p>
    </section>

    <section class="dashboard-section">
        <h2>📦 Gérer mes commandes</h2>
        <p>Créez de nouvelles commandes et suivez leur statut en temps réel.</p>
    </section>

    <section class="dashboard-section">
        <h2>📊 Statistiques personnelles</h2>
        <p>Visualisez vos commandes passées et le temps d’impression total.</p>
    </section>

    <section class="dashboard-section">
        <h2>⚙️ Paramètres & Profil</h2>
        <p>Modifiez vos informations personnelles et ajustez vos préférences.</p>
    </section>
</div>

<?php include '../../backend/includes/footer.php'; ?>

</body>
</html>
