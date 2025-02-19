<?php 
session_start();
include '../db/config.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    // 🔵 Connexion d'un utilisateur
    if ($action == "login") {
        $fullname = trim($_POST["fullname"]);
        $password = $_POST["password"];

        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE fullname = ?");
        $stmt->execute([$fullname]);
        $user = $stmt->fetch();

        // Debugging - Voir les données récupérées
        if (!$user) {
            die("⚠️ Utilisateur non trouvé dans la base de données !");
        }

        if (!password_verify($password, $user["password"])) {
            die("❌ Mot de passe incorrect !");
        }

        // Stocker les infos de session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = strtolower($user["role"]); // Mettre en minuscule pour éviter les erreurs

        // Redirection selon le rôle
        if ($_SESSION["role"] === "admin") {
            header("Location: ../views/dashboard-admin.php");
            exit();
        } elseif ($_SESSION["role"] === "user") {
            header("Location: ../views/dashboard-user.php");
            exit();
        } else {
            session_destroy();
            header("Location: ../views/login.php?error=Rôle inconnu");
            exit();
        }
    }

    // 🔵 Inscription d'un nouvel utilisateur
    if ($action == "register") {
        $fullname = trim($_POST["fullname"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $phone = trim($_POST["phone"] ?? '');
        $password = $_POST["password"] ?? '';

        // Vérifier que tous les champs sont remplis
        if (empty($fullname) || empty($email) || empty($phone) || empty($password)) {
            header("Location: ../views/register.php?error=Tous les champs sont obligatoires");
            exit();
        }

        // Vérifier si fullname ou phone existent déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE fullname = ? OR phone = ?");
        $stmt->execute([$fullname, $phone]);
        $existingUser = $stmt->fetchColumn();

        if ($existingUser > 0) {
            header("Location: ../views/register.php?error=Nom ou téléphone déjà utilisé");
            exit();
        }

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = "user"; // Par défaut, un nouvel utilisateur est "user"

        // Insérer l'utilisateur
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$fullname, $email, $phone, $hashedPassword, $role])) {
            header("Location: ../views/login.php?message=Inscription réussie");
            exit();
        } else {
            header("Location: ../views/register.php?error=Erreur lors de l'inscription");
            exit();
        }
    }
}
?>
