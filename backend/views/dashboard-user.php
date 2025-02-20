<?php 
include '../db/config.php';

session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
    header("Location: ../views/login.php");
    exit();
}

// Récupérer les infos de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateur</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>

<div class="dashboard-container">
    <h1>Bienvenue, <?php echo htmlspecialchars($user['fullname']); ?> 👋</h1>
    <p>Gérez vos commandes et vos informations personnelles ici.</p>

    <!-- Onglets -->
    <div class="tabs-container">
        <button class="tab-link active" onclick="openTab(event, 'commande')">Passer une commande</button>
        <button class="tab-link" onclick="openTab(event, 'historique')">Historique des commandes</button>
        <button class="tab-link" onclick="openTab(event, 'profil')">Modifier mon profil</button>
    </div>

    <!-- Onglet : Passer une commande -->
    <div id="commande" class="tab-content">
        <h2>Passer une commande</h2>
        <form action="../controllers/add_order.php" method="POST" enctype="multipart/form-data" class="add-order-form">
            <label for="nom_commande">Nom de la commande :</label>
            <input type="text" id="nom_commande" name="nom_commande" required>

            <label for="couleur">Couleur :</label>
            <select id="couleur" name="couleur" required>
                <option value="Rouge">Rouge</option>
                <option value="Bleu">Bleu</option>
                <option value="Vert">Vert</option>
                <option value="Jaune">Jaune</option>
                <option value="Noir">Noir</option>
                <option value="Blanc">Blanc</option>
                <option value="Gris">Gris</option>
                <option value="Orange">Orange</option>
                <option value="Rose">Rose</option>
                <option value="Violet">Violet</option>
            </select>

            <label for="hauteur">Hauteur (mm) :</label>
            <input type="number" id="hauteur" name="hauteur" step="0.1" required>

            <label for="longueur">Longueur (mm) :</label>
            <input type="number" id="longueur" name="longueur" step="0.1" required>

            <label for="largeur">Largeur (mm) :</label>
            <input type="number" id="largeur" name="largeur" step="0.1" required>

            <label for="fichier_stl">Fichier STL :</label>
            <input type="file" id="fichier_stl" name="fichier_stl" accept=".stl" required>

            <button type="submit">Passer la commande</button>
        </form>
    </div>

   <!-- Onglet : Historique des commandes -->
    <div id="historique" class="tab-content">
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



    <!-- Onglet : Modifier mon profil -->
    <div id="profil" class="tab-content">
        <div class="profile-form">                  
            <h2>Modifier mon profil</h2>
            <form action="../controllers/update_profile.php" method="POST" class="profile-form">
                <label for="fullname">Nom complet :</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label for="password">Nouveau mot de passe (laisser vide si inchangé) :</label>
                <input type="password" id="password" name="password">

                <button type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>

    <script src="/public/js/tabs.js"></script>
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
    <script>
    function checkNotifications() {
        fetch('../controllers/get_notifications.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('notification-area').innerHTML = data;
            })
            .catch(error => console.error("Erreur de notification :", error));
    }

    // Rafraîchir toutes les 10 secondes
    setInterval(checkNotifications, 10000);

    // Vérifier immédiatement au chargement de la page
    document.addEventListener("DOMContentLoaded", checkNotifications);
    </script>
    <script>
        function filterOrders() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let orders = document.querySelectorAll(".order-card");

            orders.forEach(order => {
                let name = order.getAttribute("data-name").toLowerCase();
                let status = order.getAttribute("data-status").toLowerCase();
                let date = order.getAttribute("data-date").toLowerCase();

                if (name.includes(input) || status.includes(input) || date.includes(input)) {
                    order.style.display = "block";
                } else {
                    order.style.display = "none";
                }
            });
        }
    </script>



<?php include '../includes/footer.php'; ?>

</body>
</html>
