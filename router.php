<?php
session_start();

// Vérification de la session utilisateur
$is_logged_in = isset($_SESSION['user_id']);
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Récupération et nettoyage de l'URI demandée
$request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Si aucune route n'est spécifiée, afficher la page d'accueil
if ($request_uri === '' || $request_uri === 'index') {
    require_once __DIR__ . '/backend/views/index.php';
    exit;
}

// Vérification si c'est un fichier statique (CSS, JS, images)
if (file_exists(__DIR__ . '/' . $request_uri) && is_file(__DIR__ . '/' . $request_uri)) {
    return false;
}

// Définition des routes accessibles
$routes = [
    'login' => 'backend/views/login.php',
    'logout' => 'backend/views/logout.php',
    'inscription' => 'backend/views/inscription.php',
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
    exit;
}

// Gestion des erreurs 404
http_response_code(404);
echo "<h1>404 - Page non trouvée</h1>";
?>
