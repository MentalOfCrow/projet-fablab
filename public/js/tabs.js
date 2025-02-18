function openTab(event, tabName) {
    var i, tabContent, tabLinks;

    // Masquer tous les contenus
    tabContent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }

    // Retirer la classe active des boutons
    tabLinks = document.getElementsByClassName("tab-link");
    for (i = 0; i < tabLinks.length; i++) {
        tabLinks[i].classList.remove("active");
    }

    // Afficher l'onglet sélectionné
    document.getElementById(tabName).style.display = "block";
    event.currentTarget.classList.add("active");
}

// Afficher par défaut l'onglet Connexion
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("login").style.display = "block";
});
