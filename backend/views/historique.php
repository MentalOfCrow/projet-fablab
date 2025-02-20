<?php
include '../db/config.php';

session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
    header("Location: ../views/login.php");
    exit();
}

// Récupérer les infos de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT fullname FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique de mes commandes</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/historique.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-user.php" class="back-btn">Retour au Dashboard</a> 
  
    <div class="container">
        <div id="historique">
            <h2>Historique de mes commandes</h2>

            <!-- Champ de recherche -->
            <input type="text" id="searchInput" placeholder="Rechercher par nom, date ou statut..." onkeyup="filterOrders()">

            <div class="order-list">
                <?php
                // Récupérer les commandes de l'utilisateur
                $stmt = $pdo->prepare("SELECT * FROM commandes WHERE utilisateur_id = ? ORDER BY date_creation DESC");
                $stmt->execute([$_SESSION["user_id"]]);

                while ($row = $stmt->fetch()) {
                    $statut = strtolower($row['statut']); // Normalisation
                    $modifiable = ($statut === 'en attente') ? true : false;
                ?>
                
                <div class='order-card' data-name="<?php echo htmlspecialchars($row['nom_commande']); ?>" data-status="<?php echo $statut; ?>" data-date="<?php echo date("d/m/Y", strtotime($row['date_creation'])); ?>">
                    <div class="order-header">
                        <h3><?php echo htmlspecialchars($row['nom_commande']); ?></h3>
                        <span class="status-label 
                            <?php 
                                echo ($statut === 'en attente') ? 'status-pending' :
                                    (($statut === 'en cours') ? 'status-in-progress' : 'status-done'); 
                            ?>">
                            <?php echo strtoupper($statut); ?>
                        </span>
                    </div>

                    <div class="order-info">
                        <p><strong>Date :</strong> <?php echo date("d/m/Y H:i", strtotime($row['date_creation'])); ?></p>
                        
                        <!-- Bouton Modifier si la commande est en attente -->
                        <?php if ($modifiable): ?>
                            <form action="/backend/views/modifier_commande.php" method="GET">
                                <input type="hidden" name="commande_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn-edit">Modifier</button>
                            </form>

                            <!-- Bouton Supprimer si la commande est en attente -->
                            <form action="/backend/controllers/supprimer_commande.php" method="GET" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                <input type="hidden" name="commande_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn-delete">Supprimer</button>
                            </form>
                        <?php else: ?>
                            <p class="non-modifiable">Modification impossible</p>
                        <?php endif; ?>
                    </div>
                </div>    
                <?php } ?>
            </div>
        </div>
    </div>     

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let orders = document.querySelectorAll('.order-card');
            orders.forEach(order => {
                let name = order.getAttribute('data-name').toLowerCase();
                let status = order.getAttribute('data-status').toLowerCase();
                let date = order.getAttribute('data-date').toLowerCase();
                if (name.includes(filter) || status.includes(filter) || date.includes(filter)) {
                    order.style.display = "block";
                } else {
                    order.style.display = "none";
                }
            });
        });
    </script>
    
<?php include '../../backend/includes/footer.php'; ?>

</body>
</html>
