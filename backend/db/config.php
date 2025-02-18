<?php
$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'fablab_db'; // Nom de la base de données
$user = 'root'; // Identifiant MySQL (par défaut sur XAMPP)
$password = ''; // Mot de passe (vide par défaut sur XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
