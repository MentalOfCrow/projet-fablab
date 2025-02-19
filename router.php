<?php
session_start();

// Vérification de la session utilisateur
$is_logged_in = isset($_SESSION['user_id']);
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Récupération de l'URI demandée
$request_uri = trim($_SERVER['REQUEST_URI'], '/');

// Si aucune route n'est spécifiée, on affiche la page d'accueil
if ($request_uri === '' || $request_uri === 'index') {
    require_once 'backend/views/index.php';
    exit;
}

// Définition des routes accessibles
$routes = [
    'login' => 'backend/views/login.php',
    'logout' => 'backend/views/logout.php',
    'inscription' => 'backend/views/inscription.php',
    'dashboard-user' => 'backend/views/dashboard-user.php',
    'dashboard-admin' => 'backend/views/dashboard-admin.php',
];

// Routes protégées nécessitant une connexion
$protected_routes = ['dashboard-user', 'dashboard-admin'];

// Vérification de l'accès aux pages protégées
if (in_array($request_uri, $protected_routes) && !$is_logged_in) {
    header("Location: /login");
    exit;
}

// Vérification de l'accès admin
if ($request_uri === 'dashboard-admin' && !$is_admin) {
    header("Location: /dashboard-user");
    exit;
}

// Redirection vers la bonne vue si la route existe
if (array_key_exists($request_uri, $routes)) {
    require_once $routes[$request_uri];
    exit;
}

// Page non trouvée (404)
http_response_code(404);
echo "<h1>404 - Page non trouvée</h1>";
?>
