<?php 
session_start();
include '../db/config.php';

// Générer un token CSRF unique si non défini
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur CSRF : Requête non autorisée.");
    }

    // Nettoyage des entrées utilisateur
    $fullname = htmlspecialchars(trim($_POST['fullname']), ENT_QUOTES, 'UTF-8');
    $password = trim($_POST['password']);

    if (empty($fullname) || empty($password)) {
        $_SESSION["error"] = "Veuillez remplir tous les champs.";
        header("Location: ../views/login.php");
        exit();
    }

    // Requête sécurisée pour éviter les injections SQL
    $stmt = $pdo->prepare("SELECT id, fullname, password, role FROM users WHERE fullname = :fullname");
    $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = htmlspecialchars($user["fullname"], ENT_QUOTES, 'UTF-8');
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
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

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
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

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
