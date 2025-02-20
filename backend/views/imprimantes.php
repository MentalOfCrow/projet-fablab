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
    <title>Liste des imprimantes</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/imprimantes.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-admin.php" class="back-btn">Retour au Dashboard</a> 
  
    <div class="container">
        <div id="imprimantes">
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

            <div class="printer-list">
                <?php
                $stmt = $pdo->query("SELECT * FROM imprimantes");
                while ($row = $stmt->fetch()) {
                    $etatColor = ($row['etat'] == 'libre') ? 'green' : (($row['etat'] == 'en impression') ? 'orange' : 'red');
                    $photoPath = "/public/uploads/{$row['photo']}";

                    echo "<div class='printer-card'>
                            <img src='$photoPath' alt='{$row['nom']}' onerror=\"this.src='/public/images/default-printer.png';\">
                            <div class='printer-info'>
                                <h3>{$row['nom']}</h3>
                                <p>Type : {$row['type']}</p>
                                <p class='etat' style='background-color: $etatColor;'>{$row['etat']}</p>

                                <!-- 🔵 Sélecteur d'état pour les admins -->
                                <form method='POST' action='../controllers/update_printer_status.php' class='status-form'>
                                    <input type='hidden' name='printer_id' value='{$row['id']}'>
                                    <select name='etat' class='status-select' onchange='this.form.submit()'>
                                        <option value='libre' " . ($row['etat'] == 'libre' ? 'selected' : '') . ">Libre</option>
                                        <option value='maintenance' " . ($row['etat'] == 'maintenance' ? 'selected' : '') . ">Maintenance</option>
                                    </select>
                                </form>";

                    // 🔥 Ajouter le timer et la barre de progression si l'imprimante est en impression
                    if ($row['etat'] == 'en impression') {
                        $stmtCommande = $pdo->prepare("
                            SELECT * FROM commandes 
                            WHERE imprimante_id = ? AND statut = 'en cours'
                            ORDER BY heure_debut DESC LIMIT 1
                        ");
                        $stmtCommande->execute([$row['id']]);
                        $commande = $stmtCommande->fetch();

                        if ($commande) {
                            $heure_debut = strtotime($commande['heure_debut']);
                            $heure_fin = $heure_debut + ($commande['duree'] * 60);
                            $temps_restant = max(0, $heure_fin - time());
                            $minutes_restantes = floor($temps_restant / 60);
                            $secondes_restantes = $temps_restant % 60;
                            $total_time = $commande['duree'] * 60; // Temps total en secondes

                            echo "<div class='impression-info'>
                                    <p><strong>Impression en cours :</strong> {$commande['nom_commande']}</p>
                                    <p><strong>Temps restant :</strong> 
                                        <span class='timer' id='printer-timer-{$commande['id']}' data-time='{$temps_restant}'>
                                            {$minutes_restantes} min {$secondes_restantes} sec
                                        </span>
                                    </p>
                                </div>";
                        }
                    }

                    // Formulaire pour supprimer l'imprimante
                    echo "<form method='POST' action='/backend/controllers/supprimer_imprimante.php' onsubmit='return confirm(\"Êtes-vous sûr de vouloir supprimer cette imprimante ?\");'>
                            <input type='hidden' name='printer_id' value='{$row['id']}'>
                            <button type='submit' class='btn-delete'>Supprimer</button>
                        </form>";

                    echo "</div></div>";
                }
                ?>
            </div>
        </div>
    </div>     


<?php include '../../backend/includes/footer.php'; ?>

<script src="/public/js/tabs.js"></script>
<script src="/public/js/updatePrints.js"></script>
<script>
    window.addEventListener('load', function() {
        document.querySelectorAll('.progress-bar').forEach(bar => {
            const orderId = bar.getAttribute('data-order-id');
            const totalTime = parseInt(bar.getAttribute('data-total-time'), 10);
            const startTime = parseInt(bar.getAttribute('data-start-time'), 10);
            const timerElement = document.getElementById(`timer-${orderId}`) || document.getElementById(`printer-timer-${orderId}`);

            if (orderId && totalTime && startTime && timerElement) {
                console.log(`🚀 Initialisation de la barre pour ID ${orderId}`);
                startProgressBar(orderId, totalTime, startTime, timerElement);
            }
        });
    });

    function startProgressBar(orderId, totalTime, startTime, timerElement) {
        const progressBar = document.getElementById(`progress-bar-${orderId}`) || document.getElementById(`printer-progress-bar-${orderId}`);
        if (!progressBar) return;

        function updateProgress() {
            const now = Math.floor(Date.now() / 1000);
            const elapsedTime = now - startTime;
            const progress = Math.min((elapsedTime / totalTime) * 100, 100);

            console.log(`📊 Progression ID ${orderId}: ${progress.toFixed(2)}%`);
            progressBar.style.width = `${progress}%`;

            let remainingTime = totalTime - elapsedTime;
            let minutes = Math.floor(remainingTime / 60);
            let seconds = remainingTime % 60;
            timerElement.innerText = `${minutes} min ${seconds} sec`;

            if (progress < 100) {
                setTimeout(updateProgress, 1000);
            } else {
                timerElement.innerText = "Terminé ✅";
                progressBar.style.backgroundColor = "#4CAF50"; // Vert
            }
        }

        updateProgress();
    }
</script>
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
    
</body>
</html>
