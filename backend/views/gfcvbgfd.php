



    <script src="/public/js/tabs.js"></script>
    
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


















/*###########################*/
/*###########################*/
/*#######HISTORIQUE##########*/





}

/* 🔍 Style du champ de recherche */
#searchInput {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    margin: 15px auto;
    display: block;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* 🎨 Conteneur des commandes */
/* 🏷 Conteneur de l'historique */
.order-list {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column; /* Alignement vertical */
    gap: 10px;
    padding: 20px;
    max-width: 800px; /* Limite la largeur */
    margin: auto; /* Centre la liste */
}

/* 📦 Cartes des commandes */
.order-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    transition: transform 0.2s ease-in-out;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 120px;  /* Ajustez la hauteur selon votre besoin */
    overflow: hidden;
}

.order-card:hover {
    transform: scale(1.05);
}

/* 🏷️ En-tête de la carte (nom + statut) */
.order-header {
    display: flex;
    align-items: center;
    gap: 15px;
}

/* 🏷️ Style des statuts */
.status-label {
    font-size: 14px;
    font-weight: bold;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    text-transform: uppercase;
}

/* 🔴 En attente */
.status-pending {
    background-color: red;
}

/* 🟠 En cours */
.status-in-progress {
    background-color: orange;
}

/* ✅ Terminé */
.status-done {
    background-color: green;
}

/* 🖊️ Bouton Modifier */
.btn-edit {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.2s ease-in-out;
}

.btn-edit:hover {
    background: #0056b3;
}

/* ⛔ Texte pour les commandes non modifiables */
.non-modifiable {
    font-size: 13px;
    font-style: italic;
    color: #888;
}







<div class="dashboard-container">
    <h1>Bonjour, <?php echo htmlspecialchars($user['fullname']); ?> 👋</h1>
    <p>Bienvenue sur votre espace administrateur du FabLab.</p>
</div>