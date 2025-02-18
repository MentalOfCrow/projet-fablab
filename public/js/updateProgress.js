function startProgressBar(orderId, totalTime, startTime) {
    const progressBar = document.getElementById(`progress-bar-${orderId}`);
    const timerElement = document.getElementById(`timer-${orderId}`);

    if (!progressBar || !timerElement) {
        console.warn(`⚠️ ProgressBar ou Timer introuvable pour l'ID: ${orderId}`);
        return;
    }

    function updateProgress() {
        const now = Math.floor(Date.now() / 1000);
        const elapsedTime = now - startTime;
        const progress = (elapsedTime / totalTime) * 100;

        console.log(`🔄 Mise à jour de la barre ID ${orderId}: ${progress.toFixed(2)}%`);

        if (progress >= 100) {
            progressBar.style.width = "100%";
            progressBar.style.backgroundColor = "#4CAF50"; // ✅ Vert à la fin
            timerElement.innerText = "Terminé";
        } else {
            progressBar.style.width = `${progress}%`;
            progressBar.style.transition = "width 1s linear"; // Animation fluide

            let remainingTime = totalTime - elapsedTime;
            let minutes = Math.floor(remainingTime / 60);
            let seconds = remainingTime % 60;
            timerElement.innerText = `${minutes} min ${seconds} sec`;

            setTimeout(updateProgress, 1000);
        }
    }

    console.log(`🚀 Démarrage de la barre pour ID ${orderId}`);
    updateProgress();
}

// ✅ Exécuter la mise à jour après le chargement total de la page
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.progress-bar').forEach(bar => {
        const orderId = bar.getAttribute('data-order-id');
        const totalTime = parseInt(bar.getAttribute('data-total-time'));
        const startTime = parseInt(bar.getAttribute('data-start-time'));

        if (orderId && totalTime && startTime) {
            console.log(`⏳ Initialisation auto pour ID ${orderId}`);
            startProgressBar(orderId, totalTime, startTime);
        }
    });
});
