<?php
// Démarrer la session
session_start();

// Supprimer toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil ou la page de connexion
header("Location: /backend/views/index.php");
exit();
?>
