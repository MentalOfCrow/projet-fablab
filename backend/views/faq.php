<?php
// Vérifier si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - FabLab</title>
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <link rel="stylesheet" href="/public/assets/css/faq.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include_once __DIR__ . '/../includes/header.php'; ?>

<!-- Bannière améliorée -->
<section class="faq-banner">
    <div class="banner-content">
        <h1>Foire Aux Questions (FAQ)</h1>
        <p>Retrouvez ici les réponses aux questions les plus courantes sur notre plateforme et l'impression 3D.</p>
    </div>
</section>

<!-- Contenu principal -->
<main class="faq-container">
    <h2 class="faq-title">Questions Fréquentes</h2>
    <div class="faq">

        <div class="faq-item">
            <button class="faq-question">Comment créer une commande d'impression 3D ?</button>
            <div class="faq-answer">
                <p>Pour passer une commande d'impression 3D, accédez à votre tableau de bord, téléchargez votre fichier STL, choisissez les paramètres d'impression (type de filament, couleur, résolution) et validez la commande. Un suivi en temps réel de votre commande est disponible.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Quels types de filaments sont disponibles ?</button>
            <div class="faq-answer">
                <p>Nous proposons plusieurs types de filaments adaptés à vos besoins : PLA (écologique et facile à imprimer), ABS (robuste et résistant à la chaleur), PETG (solide et légèrement flexible), et TPU (souple et élastique pour des impressions flexibles).</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Combien de temps prend une impression ?</button>
            <div class="faq-answer">
                <p>Le temps d'impression varie selon la taille et la complexité de votre modèle. Une impression simple peut prendre 30 minutes, tandis qu'un modèle détaillé peut nécessiter plusieurs heures, voire une journée entière pour des objets volumineux.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Quel est le coût d'une impression 3D ?</button>
            <div class="faq-answer">
                <p>Le prix d'une impression dépend de plusieurs facteurs : le volume de matière utilisée, la durée d'impression, le type de filament choisi et les paramètres de précision. Un devis estimatif est généré avant validation de votre commande.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Comment savoir si mon fichier STL est valide ?</button>
            <div class="faq-answer">
                <p>Avant de lancer une impression, nous vous recommandons d'utiliser un logiciel de vérification comme Meshmixer ou Netfabb pour détecter d'éventuelles erreurs dans votre fichier STL et assurer une impression réussie.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Puis-je annuler une impression en cours ?</button>
            <div class="faq-answer">
                <p>Oui, vous pouvez annuler une impression tant qu'elle n'a pas encore commencé. Une fois l'impression en cours, il est impossible de l'interrompre sans perdre les matériaux utilisés. Vérifiez bien vos paramètres avant de valider la commande.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Quels sont les formats de fichiers acceptés ?</button>
            <div class="faq-answer">
                <p>Notre plateforme accepte principalement les fichiers STL, OBJ et 3MF pour l'impression 3D. Assurez-vous que votre fichier est bien exporté dans l'un de ces formats avant de le téléverser.</p>
            </div>
        </div>

    </div>
</main>

<!-- Script pour afficher les réponses aux questions -->
<script>
document.querySelectorAll(".faq-question").forEach(button => {
    button.addEventListener("click", () => {
        button.classList.toggle("active");
        let answer = button.nextElementSibling;
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
        }
    });
});
</script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
