<?php
session_start();
include '../db/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
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
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>

<div class="dashboard-container">
    <h1>Bonjour, <?php echo htmlspecialchars($user['fullname']); ?> 👋</h1>
    <p>Bienvenue sur votre espace administrateur du FabLab.</p>

    <!-- Onglets -->
     <div class="tabs-container">
        <div class="tabs1">
            <button class="tab-link active" onclick="openTab(event, 'commande')">Passer une commande</button>
            <button class="tab-link" onclick="openTab(event, 'attente')">Impressions en attente</button>
            <button class="tab-link" onclick="openTab(event, 'encours')">Impressions en cours</button>
        </div>
        <div class="tabs2">    
            <button class="tab-link" onclick="openTab(event, 'terminees')">Impressions terminées</button>
            <button class="tab-link" onclick="openTab(event, 'imprimantes')">Liste des imprimantes</button>
            <button class="tab-link" onclick="openTab(event, 'utilisateurs')">Gestion des utilisateurs</button>
            <button class="tab-link" onclick="openTab(event, 'export')">Export</button>
        </div>
    </div>

    <!-- Contenus des onglets -->
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

    <div id="attente" class="tab-content">
        <h2>Commandes en attente</h2>
        
        <div class="order-list">
            <?php
            // Récupérer les imprimantes disponibles (état = libre)
            $stmtImprimantes = $pdo->query("SELECT id, nom FROM imprimantes WHERE etat = 'libre'");
            $imprimantes = $stmtImprimantes->fetchAll();

            // Récupérer les commandes en attente
            $stmt = $pdo->query("
                SELECT commandes.*, users.fullname 
                FROM commandes
                JOIN users ON commandes.utilisateur_id = users.id
                WHERE commandes.statut = 'en attente'
                ORDER BY commandes.date_creation DESC
            ");

            while ($row = $stmt->fetch()) {
                $date_formatee = date("d/m/Y H:i", strtotime($row['date_creation']));
                echo "<div class='order-card'>
                        <div class='order-info'>
                            <h3>{$row['nom_commande']}</h3>
                            <p><strong>Client :</strong> {$row['fullname']}</p>
                            <p><strong>Couleur :</strong> {$row['couleur']}</p>
                            <p><strong>Dimensions :</strong> {$row['hauteur']}mm x {$row['longueur']}mm x {$row['largeur']}mm</p>
                            <p><strong>Fichier STL :</strong> <a href='/public/uploads/{$row['fichier_stl']}' download>Télécharger</a></p>
                            <p><strong>Date :</strong> {$date_formatee}</p>
                            <p class='status waiting'>En attente</p>

                            <!-- Sélection de l'imprimante et durée -->
                            <form method='POST' action='../controllers/start_printing.php'>
                                <input type='hidden' name='commande_id' value='{$row['id']}'>

                                <label for='imprimante'>Sélectionner une imprimante :</label>
                                <select name='imprimante_id' required>
                                    <option value=''>Sélectionner...</option>";
                                    foreach ($imprimantes as $imprimante) {
                                        echo "<option value='{$imprimante['id']}'>{$imprimante['nom']}</option>";
                                    }
                                echo "</select>

                                <label for='duree'>Durée de l'impression (en min) :</label>
                                <input type='number' name='duree' min='1' required>

                                <button type='submit'>Lancer l'impression</button>
                            </form>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>


    <div id="encours" class="tab-content">
        <h2>Impressions en cours</h2>
        
        <div class="order-list">
            <?php
            $stmt = $pdo->query("
                SELECT commandes.*, imprimantes.nom AS imprimante_nom 
                FROM commandes
                JOIN imprimantes ON commandes.imprimante_id = imprimantes.id
                WHERE commandes.statut = 'en cours'
                ORDER BY commandes.heure_debut DESC
            ");

            while ($row = $stmt->fetch()) {
                $heure_debut = strtotime($row['heure_debut']);
                $heure_fin = $heure_debut + ($row['duree'] * 60);
                $temps_restant = max(0, $heure_fin - time());
                $minutes_restantes = floor($temps_restant / 60);
                $secondes_restantes = $temps_restant % 60;

                echo "<div class='order-card'>
                        <div class='order-info'>
                            <h3>{$row['nom_commande']}</h3>
                            <p><strong>Imprimante :</strong> {$row['imprimante_nom']}</p>
                            <p><strong>Temps restant :</strong> <span class='timer' data-time='$temps_restant'>{$minutes_restantes} min {$secondes_restantes} sec</span></p>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>

    <script>
        function updateTimers() {
            document.querySelectorAll('.timer').forEach(timer => {
                let time = parseInt(timer.getAttribute('data-time'));
                if (time > 0) {
                    time--;
                    timer.setAttribute('data-time', time);
                    let minutes = Math.floor(time / 60);
                    let seconds = time % 60;
                    timer.innerText = minutes + " min " + seconds + " sec";
                } else {
                    timer.innerText = "Terminé";
                }
            });
        }
        setInterval(updateTimers, 1000);
    </script>


    <div id="terminees" class="tab-content">
        <h2>Impressions terminées</h2>
        
        <div class="order-list">
            <?php
            $stmt = $pdo->query("
                SELECT commandes.*, imprimantes.nom AS imprimante_nom 
                FROM commandes
                JOIN imprimantes ON commandes.imprimante_id = imprimantes.id
                WHERE commandes.statut = 'terminé'
                ORDER BY commandes.heure_debut DESC
            ");

            while ($row = $stmt->fetch()) {
                echo "<div class='order-card'>
                        <div class='order-info'>
                            <h3>{$row['nom_commande']}</h3>
                            <p><strong>Imprimante :</strong> {$row['imprimante_nom']}</p>
                            <p><strong>Statut :</strong> ✅ Terminé</p>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>


    <div id="imprimantes" class="tab-content">
        <h2>Liste des imprimantes</h2>

        <!-- Formulaire d'ajout d'imprimante -->
        <form action="../controllers/add_printer.php" method="POST" enctype="multipart/form-data" class="add-printer-form">
            <label for="nom">Nom de l'imprimante :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="type">Type d'impression :</label>
            <select id="type" name="type" required>
                <option value="résine">Résine</option>
                <option value="filament">Filament</option>
            </select>

            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>

            <button type="submit">Ajouter l'imprimante</button>
        </form>

        <!-- Liste des imprimantes -->
        <div class="printer-list">
            <?php
            $stmt = $pdo->query("SELECT * FROM imprimantes");
            while ($row = $stmt->fetch()) {
                $etatColor = ($row['etat'] == 'libre') ? 'green' : (($row['etat'] == 'en impression') ? 'orange' : 'red');
                $photoPath = "/public/uploads/{$row['photo']}"; // Correction du chemin
                echo "<div class='printer-card'>
                        <img src='$photoPath' alt='{$row['nom']}' onerror=\"this.src='/public/images/default-printer.png';\">
                        <div class='printer-info'>
                            <h3>{$row['nom']}</h3>
                            <p>Type : {$row['type']}</p>
                            <p class='etat' style='background-color: $etatColor;'>{$row['etat']}</p>
                            <form method='POST' action='../controllers/update_printer.php'>
                                <input type='hidden' name='printer_id' value='{$row['id']}'>
                                <select name='etat' onchange='this.form.submit()'>
                                    <option value='libre' " . ($row['etat'] == 'libre' ? 'selected' : '') . ">Libre</option>
                                    <option value='en impression' " . ($row['etat'] == 'en impression' ? 'selected' : '') . ">En Impression</option>
                                    <option value='maintenance' " . ($row['etat'] == 'maintenance' ? 'selected' : '') . ">Maintenance</option>
                                </select>
                            </form>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>

    <div id="utilisateurs" class="tab-content">
        <h2>Gestion des utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody id="user-list">
                <!-- Les utilisateurs seront affichés ici via PHP -->
                <?php
                $stmt = $pdo->query("SELECT id, fullname, email, role FROM users");
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <form method='POST' action='../controllers/update_user.php'>
                                    <input type='hidden' name='user_id' value='{$row['id']}'>
                                    <select name='role' onchange='this.form.submit()'>
                                        <option value='user' " . ($row['role'] == 'user' ? 'selected' : '') . ">Utilisateur</option>
                                        <option value='admin' " . ($row['role'] == 'admin' ? 'selected' : '') . ">Administrateur</option>
                                    </select>
                                </form>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="export" class="tab-content">
        <h2>Exporter les données</h2>

        <!-- Formulaire pour exporter les commandes -->
        <form action="../controllers/export_orders.php" method="POST" class="export-form">
            <button type="submit" name="export_orders">📜 Exporter l'historique des commandes (PDF)</button>
        </form>

        <!-- Formulaire pour exporter les statistiques -->
        <form action="../controllers/export_stats.php" method="POST" class="export-form">
            <button type="submit" name="export_stats">📊 Exporter les statistiques (PDF)</button>
        </form>
    </div>

</div>

<script src="/public/js/tabs.js"></script>
<script src="/public/js/updatePrints.js"></script>


<?php include '../includes/footer.php'; ?>

</body>
</html>