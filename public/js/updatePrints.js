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
setInterval(checkCompletedPrints, 300000);
