<?php 
session_start();
include '../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION["error"] = "Veuillez remplir tous les champs.";
        header("Location: ../views/login.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Format d'email invalide.";
        header("Location: ../views/login.php");
        exit();
    }

    // Préparation et exécution de la requête
    $stmt = $pdo->prepare("SELECT id, fullname, password, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    // Vérification du mot de passe
    if (password_verify($password, $user['password'])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];
        $_SESSION["role"] = strtolower($user["role"]); // Toujours en minuscule

        if ($_SESSION["role"] === "admin") {
            header("Location: ../views/dashboard-admin.php");
        } elseif ($_SESSION["role"] === "user") {
            header("Location: ../views/dashboard-user.php");
        } else {
            session_destroy();
            $_SESSION["error"] = "Accès refusé.";
            header("Location: ../views/login.php");
            exit();
        }
        exit();
    } else {
        $_SESSION["error"] = "Mot de passe incorrect.";
        header("Location: ../views/login.php");
        exit();
    }
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
        <form action="/backend/controllers/auth_controller.php" method="POST">
            <input type="hidden" name="action" value="login">
            
            <label for="fullname">Nom complet :</label>
            <input type="text" id="fullname" name="fullname" required>
            
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
