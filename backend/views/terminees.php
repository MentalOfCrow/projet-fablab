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
    <title>Impressions terminées</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/terminees.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-admin.php" class="back-btn">Retour au Dashboard</a> 
  
    <div class="container">
        <div id="terminees">
            <h2>Impressions terminées</h2>

            <div class="order-list1">
                <?php
                // Nombre de commandes par page
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

                while ($row = $stmt->fetch()) {
                    echo "<div class='order-card1'>
                            <div class='order-info1'>
                                <h3>" . htmlspecialchars($row['nom_commande']) . "</h3>
                                <p><strong>Imprimante :</strong> " . htmlspecialchars($row['imprimante_nom']) . "</p>
                                <p><strong>Statut :</strong> ✅ Terminé</p>
                            </div>
                        </div>";
                }
                ?>
            </div>

            <!-- 🔄 Pagination -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="pagination-btn">⬅ Précédent</a>
                <?php endif; ?>

                <span class="current-page">Page <?php echo $page; ?> sur <?php echo $totalPages; ?></span>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="pagination-btn">Suivant ➡</a>
                <?php endif; ?>
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
