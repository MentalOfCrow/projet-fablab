<?php
include '../db/config.php';

session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
    header("Location: ../views/login.php");
    exit();
}

// Récupérer les infos de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT fullname, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

// Vérifier si l'utilisateur a bien été récupéré
if ($user) {
    $fullname = htmlspecialchars($user['fullname']);
    $email = htmlspecialchars($user['email']);
} else {
    echo "Utilisateur non trouvé.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/modifier_profil.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-user.php" class="back-btn">Retour au Dashboard</a> 
  
<div class="container">
    <div id="profil">
        <div class="profile-form">                  
            <h2>Modifier mon profil</h2>
            <form action="../controllers/update_profile.php" method="POST" class="profile-form">
                <label for="fullname">Nom complet :</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

                <label for="password">Nouveau mot de passe (laisser vide si inchangé) :</label>
                <input type="password" id="password" name="password">

                <button type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>     

<?php include '../../backend/includes/footer.php'; ?>

</body>
</html>
