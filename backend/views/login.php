<?php
// Démarrer la session si besoin
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/login.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>

<div class="login-container">
    <div class="tabs">
        <button class="tab-link active" onclick="openTab(event, 'login')">Connexion</button>
        <button class="tab-link" onclick="openTab(event, 'register')">Inscription</button>
    </div>

    <!-- Formulaire de Connexion -->
    <div id="login" class="tab-content active">
        <h2>Connexion</h2>
        <form action="../controllers/auth_controller.php" method="POST">
            <input type="hidden" name="action" value="login">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>

    <!-- Formulaire d'Inscription -->
    <div id="register" class="tab-content">
        <h2>Inscription</h2>
        <form action="../controllers/auth_controller.php" method="POST">
            <input type="hidden" name="action" value="register">
            <label for="fullname">Nom :</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Téléphone :</label>
            <input type="text" id="phone" name="phone" required>

            <label for="password_reg">Mot de passe :</label>
            <input type="password" id="password_reg" name="password" required>

            <button type="submit">S'inscrire</button>
        </form>
    </div>
</div>

<script src="/public/js/tabs.js"></script>

<?php include '../../backend/includes/footer.php'; ?>

</body>
</html>
