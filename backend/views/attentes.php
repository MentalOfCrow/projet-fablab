<?php
include '../db/config.php';

session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
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
    <title>Impressions en attentes</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/attentes.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-admin.php" class="back-btn">Retour au Dashboard</a> 
  
    <div class="container">
        <div id="attente">
            <h2 class="titre">Commandes en attentes</h2>

            <div class="order-list1">
                <?php
                // Récupérer les imprimantes disponibles (état = libre)
                $stmtImprimantes = $pdo->query("SELECT id, nom, type FROM imprimantes WHERE etat = 'libre'");
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
                    echo "<div class='order-card1'>
                            <div class='order-info1'>
                                <h3>{$row['nom_commande']}</h3>
                                <p><strong>Client :</strong> {$row['fullname']}</p>
                                <p><strong>Couleur :</strong> {$row['couleur']}</p>
                                <p><strong>Materiel :</strong> {$row['type_impression']}</p>
                                <p><strong>Dimensions :</strong> {$row['hauteur']}mm x {$row['longueur']}mm x {$row['largeur']}mm</p>
                                <p><strong>Fichier STL :</strong> <a href='/public/uploads/{$row['fichier_stl']}' download>Télécharger</a></p>
                                <p><strong>Date :</strong> {$date_formatee}</p>
                                <p class='status waiting'>En attente</p>

                                <!-- Sélection de l'imprimante et durée -->
                                <form method='POST' action='../controllers/start_printing.php'>
                                    <input type='hidden' name='commande_id' value='{$row['id']}'>
                                    
                                    <label for='type_impression'>Type d'impression :</label>
                                    <input type='hidden' name='type_impression' value='{$row['type_impression']}'> 

                                    <label for='imprimante'>Sélectionner une imprimante :</label>
                                    <select name='imprimante_id' id='imprimante_id_{$row['id']}' required>
                                        <option value=''>Sélectionner...</option>
                                    </select>

                                    <label for='duree'>Durée de l'impression (en min) :</label>
                                    <input type='number' name='duree' min='1' required>

                                    <button type='submit'>Lancer l'impression</button>
                                </form>
                            </div>
                        </div>";

                    // Générer un script JavaScript pour filtrer les imprimantes en fonction du type d'impression
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const typeImpression = '{$row['type_impression']}'; // Récupérer le type d'impression
                            const imprimanteSelect = document.getElementById('imprimante_id_{$row['id']}'); // Sélectionner le bon menu déroulant
                            
                            // Vider les options précédentes
                            imprimanteSelect.innerHTML = '<option value=\"\">Sélectionner...</option>';

                            // Filtrer les imprimantes disponibles selon le type d'impression
                            const imprimantes = " . json_encode($imprimantes) . ";
                            const filteredImprimantes = imprimantes.filter(imprimante => imprimante.type === typeImpression);

                            // Ajouter les imprimantes filtrées au menu déroulant
                            filteredImprimantes.forEach(imprimante => {
                                const option = document.createElement('option');
                                option.value = imprimante.id;
                                option.textContent = imprimante.nom;
                                imprimanteSelect.appendChild(option);
                            });
                        });
                    </script>";
                }
                ?>
            </div>
        </div>
    </div>



<?php include '../../backend/includes/footer.php'; ?>

</body>
</html>
