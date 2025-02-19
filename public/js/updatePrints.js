function checkCompletedPrints() {
    fetch('../controllers/check_completed_prints.php')
        .then(response => response.text())
        .then(data => {
            console.log("Mise à jour des impressions terminées.");
            location.reload(); // Recharge la page pour voir les mises à jour
        })
        .catch(error => console.error('Erreur lors de la mise à jour des impressions terminées:', error));
}

// Rafraîchir toutes les 30 secondes
setInterval(checkCompletedPrints, 30000);

document.addEventListener("DOMContentLoaded", function () {
    let currentPage = 1;
    const ordersContainer = document.getElementById("completed-orders");
    const prevBtn = document.getElementById("prevPage");
    const nextBtn = document.getElementById("nextPage");
    const currentPageDisplay = document.getElementById("currentPage");

    function loadOrders(page) {
        fetch(`../controllers/get_completed_orders.php?page=${page}`)
            .then(response => response.json())
            .then(data => {
                ordersContainer.innerHTML = ""; // Effacer le contenu actuel

                data.orders.forEach(order => {
                    let orderCard = `
                        <div class='order-card'>
                            <div class='order-info'>
                                <h3>${order.nom_commande}</h3>
                                <p><strong>Imprimante :</strong> ${order.imprimante_nom}</p>
                                <p><strong>Statut :</strong> ✅ Terminé</p>
                            </div>
                        </div>
                    `;
                    ordersContainer.innerHTML += orderCard;
                });

                currentPage = data.currentPage;
                currentPageDisplay.textContent = `Page ${currentPage} sur ${data.totalPages}`;
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === data.totalPages;
            })
            .catch(error => console.error("Erreur lors du chargement :", error));
    }

    prevBtn.addEventListener("click", () => {
        if (currentPage > 1) {
            loadOrders(currentPage - 1);
        }
    });

    nextBtn.addEventListener("click", () => {
        loadOrders(currentPage + 1);
    });

    // Charger les données de la première page au chargement
    loadOrders(currentPage);
});
