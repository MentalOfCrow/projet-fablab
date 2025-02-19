<?php
include '../db/config.php';

$limit = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Récupérer le nombre total de commandes terminées
$stmtCount = $pdo->query("SELECT COUNT(*) FROM commandes WHERE statut = 'terminé'");
$totalOrders = $stmtCount->fetchColumn();
$totalPages = ceil($totalOrders / $limit);

// Récupérer les commandes avec pagination
$stmt = $pdo->prepare("
    SELECT commandes.*, imprimantes.nom AS imprimante_nom 
    FROM commandes
    JOIN imprimantes ON commandes.imprimante_id = imprimantes.id
    WHERE commandes.statut = 'terminé'
    ORDER BY commandes.heure_debut DESC
    LIMIT :limit OFFSET :offset
");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoyer les résultats en JSON pour JavaScript
echo json_encode([
    'orders' => $orders,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);
?>
