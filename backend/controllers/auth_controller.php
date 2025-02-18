<?php
session_start();
include '../db/config.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "login") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["role"] = $user["role"];
            header("Location: ../views/dashboard-admin.php");
            exit();
        } else {
            echo "Identifiants incorrects.";
        }
    }

    if ($action == "register") {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $role = "user"; // Forcer le rôle par défaut à "user"

        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$fullname, $email, $phone, $password, $role])) {
            header("Location: ../views/login.php?message=Inscription réussie");
            exit();
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
}
?>
