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
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/gestion.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include '../../backend/includes/header.php'; ?>
<a href="/backend/views/dashboard-admin.php" class="back-btn">Retour au Dashboard</a> 
  
    <div class="container">
        <div id="utilisateurs"> 
            <h2>Gestion des utilisateurs</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Action</th> <!-- Nouvelle colonne pour l'action -->
                    </tr>
                </thead>
                <tbody id="user-list">
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
                                <td>
                                    <!-- Formulaire pour supprimer l'utilisateur -->
                                    <form method='POST' action='../controllers/supprimer_user.php' onsubmit='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\");'>
                                        <input type='hidden' name='user_id' value='{$row['id']}'>
                                        <button type='submit' class='btn-delete'>Supprimer</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
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
