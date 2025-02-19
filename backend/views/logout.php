<?php
session_start();
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session

// Redirige vers la page d'accueil à la racine du site
header("Location: /");
exit();
?>
