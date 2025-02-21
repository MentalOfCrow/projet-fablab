// app.js

let currentIndex = 0;
const images = document.querySelectorAll('.carousel-image');
const totalImages = images.length;

// Fonction pour changer l'image affichée
function changeImage() {
    images.forEach((img, index) => {
        img.classList.remove('active'); // Masquer toutes les images
        if (index === currentIndex) {
            img.classList.add('active'); // Afficher l'image actuelle
        }
    });
    currentIndex = (currentIndex + 1) % totalImages; // Passer à l'image suivante
}

// Initialisation de l'animation au chargement
document.addEventListener('DOMContentLoaded', () => {
    changeImage(); // Afficher la première image
    setInterval(changeImage, 3000); // Changer d'image toutes les 3 secondes
});
