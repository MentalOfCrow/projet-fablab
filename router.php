<?php
session_start();

// Vérification de la session utilisateur
$is_logged_in = isset($_SESSION['user_id']);
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Récupération et nettoyage de l'URI demandée
$request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Forcer la suppression des éventuels espaces et nettoyer les buffers de sortie
ob_start();

// Si aucune route n'est spécifiée ou si c'est "index", rediriger vers la page principale
if ($request_uri === '' || $request_uri === 'index') {
    header("Location: /backend/views/index.php");
    ob_end_flush();
    exit();
}

// Vérification si c'est un fichier statique (CSS, JS, images)
$file_path = __DIR__ . '/' . $request_uri;
if (file_exists($file_path) && is_file($file_path)) {
    return false;
}

// Définition des routes accessibles
$routes = [
    'login' => 'backend/views/login.php',
    'logout' => 'backend/views/logout.php',
    'dashboard-user' => 'backend/views/dashboard-user.php',
    'dashboard-admin' => 'backend/views/dashboard-admin.php',
    'about' => 'backend/views/about.php',
    'help' => 'backend/views/help.php',
    'faq' => 'backend/views/faq.php',
    'contact' => 'backend/views/contact.php',
    'terms' => 'backend/views/terms.php',
    'privacy' => 'backend/views/privacy.php',
];

// Vérification et inclusion des fichiers de vue
if (array_key_exists($request_uri, $routes)) {
    require_once __DIR__ . '/' . $routes[$request_uri];
    ob_end_flush();
    exit();
}

// Si la route est invalide, rediriger vers la page principale **avec arrêt immédiat**
header("Location: /backend/views/index.php", true, 302);
ob_end_flush();
exit();
?>
