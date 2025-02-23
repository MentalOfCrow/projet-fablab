document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour charger les notifications via AJAX
    function loadNotifications() {
        fetch('/backend/controllers/get_notifications.php')  // Créer ce fichier pour récupérer les notifications
            .then(response => response.json())
            .then(data => {
                const notificationsList = document.getElementById('notifications-list');
                notificationsList.innerHTML = '';  // Vider la liste actuelle
                
                // Ajouter chaque notification
                data.notifications.forEach(notification => {
                    const li = document.createElement('li');
                    li.textContent = notification.message;
                    li.classList.add(notification.status);
                    li.dataset.id = notification.id;
                    
                    // Marquer la notification comme lue lorsqu'elle est cliquée
                    li.addEventListener('click', function() {
                        markAsRead(notification.id);
                    });
                    
                    notificationsList.appendChild(li);
                });
            });
    }

    // Fonction pour marquer une notification comme lue
    function markAsRead(notificationId) {
        fetch('/backend/controllers/mark_as_read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ notificationId: notificationId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications();  // Recharge les notifications après avoir marqué celle-ci comme lue
            }
        });
    }

    // Charger les notifications dès le chargement de la page
    loadNotifications();
});

fetch('/backend/controllers/get_notifications.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);  // Afficher l'erreur si aucun résultat
        } else {
            const notificationsList = document.getElementById('notifications-list');
            notificationsList.innerHTML = '';  // Vider la liste actuelle

            // Ajouter chaque notification
            data.notifications.forEach(notification => {
                const li = document.createElement('li');
                li.textContent = notification.message;
                li.classList.add(notification.status);
                li.dataset.id = notification.id;

                // Marquer la notification comme lue lorsqu'elle est cliquée
                li.addEventListener('click', function() {
                    markAsRead(notification.id);
                });

                notificationsList.appendChild(li);
            });
        }
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des notifications:', error);
    });
