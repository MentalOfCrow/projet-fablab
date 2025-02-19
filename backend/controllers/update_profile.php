<?php
session_start();
include '../db/config.php'; // Assure-toi que le chemin est bon

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_id = $_SESSION["user_id"];

    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET fullname = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$fullname, $email, $password_hashed, $user_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET fullname = ?, email = ? WHERE id = ?");
        $stmt->execute([$fullname, $email, $user_id]);
    }

    header("Location: ../views/dashboard-user.php?message=Profil mis à jour");
    exit();
}
?>
