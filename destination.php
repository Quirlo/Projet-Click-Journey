<?php
session_start();

$tripsFile = 'data/trips.json';
$trips = json_decode(file_get_contents($tripsFile), true);
if ($trips === null) {
    echo "<p>Erreur de lecture du fichier trips.json</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xplore - Destinations Trekking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/styledestination.css">
</head>
<body>

<section class="header">
    <a href="index.php" class="logo">XPlore</a>
    <nav class="navbar">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'administrator') : ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>
        <a href="index.php">Accueil</a>
        <a href="destination.php">Destination</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="profil.php">Mon Profil</a>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion.php">Se connecter</a>
        <?php endif; ?>
    </nav>
    <div class="menu-reduit" id="menu-reduit"><i class="fas fa-bars"></i></div>
</section>

<div class="menu-redu">
    <a href="admin.php">Admin</a>
    <a href="index.php">Accueil</a>
    <a href="destination.php">Destination</a>
    <a href="profil.php">Mon Profil</a>
    <a href="inscription.php">Se connecter</a>
</div>

<section id="filters">
    <form id="searchForm" onsubmit="event.preventDefault(); filterDestinations();">
        <div class="filter-group">
            <label for="searchKeyword">Mots-clés :</label>
            <input type="text" id="searchKeyword" placeholder="Ex: Alpes, Zanzibar, glacier..." />
        </div>

        <div class="filter-group">
            <label for="difficulty">Difficulté :</label>
            <select id="difficulty">
                <option value="">-- Choisissez --</option>
                <option value="facile">Facile</option>
                <option value="moyenne">Moyenne</option>
                <option value="difficile">Difficile</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="season">Saison idéale :</label>
            <select id="season">
                <option value="">-- Choisissez --</option>
                <option value="été">Été</option>
                <option value="hiver">Hiver</option>
                <option value="automne">Automne</option>
                <option value="printemps">Printemps</option>
            </select>
        </div>

        <button type="submit" class="btn-search">Rechercher</button>
    </form>
</section>

<div class="destination-cards">
    <?php foreach ($trips as $trip): ?>
        <?php 
            $searchData = strtolower($trip['title'] . ' ' . $trip['description'] . ' ' . $trip['long_description']); 
        ?>
        <div class="destination-card <?= $trip['slug'] ?> <?= $trip['difficulty'] ?> <?= $trip['season'] ?>" data-search="<?= htmlspecialchars($searchData) ?>">
            <img src="<?= htmlspecialchars($trip['image']) ?>" alt="<?= htmlspecialchars($trip['title']) ?>">
            <h3><?= htmlspecialchars($trip['title']) ?></h3>
            <p><?= htmlspecialchars($trip['description']) ?></p>
            <a href="voyage.php?id=<?= $trip['id'] ?>" class="btn-consulter">Réserver</a>
        </div>
    <?php endforeach; ?>
</div>

<script>
    const MenuButton = document.querySelector('.menu-reduit');
    const MenuButtonICON = document.querySelector('.menu-reduit i');
    const Menu = document.querySelector('.menu-redu');

    MenuButton.onclick = function () {
        Menu.classList.toggle('open');
        const isOpen = Menu.classList.contains('open');
        MenuButtonICON.classList = isOpen ? 'fas fa-xmark' : 'fas fa-bars';
    }

    function filterDestinations() {
        const keyword = document.getElementById("searchKeyword").value.toLowerCase();
        const difficulty = document.getElementById("difficulty").value;
        const season = document.getElementById("season").value;

        const cards = document.querySelectorAll('.destination-card');
        cards.forEach(card => {
            const searchText = card.getAttribute('data-search');
            const matchKeyword = searchText.includes(keyword) || keyword === "";
            const matchDifficulty = card.classList.contains(difficulty) || difficulty === "";
            const matchSeason = card.classList.contains(season) || season === "";

            if (matchKeyword && matchDifficulty && matchSeason) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
</script>
<footer>
        <div class="footer-container">
            <div class="footer-section">
                <h2>XPlore</h2>
                <p>Vivez une aventure</p>
            </div>
            <div class="footer-section">
                <h3>À propos</h3>
                <ul>
                    <li><a href="#">Qui sommes-nous ?</a></li>
                    <li><a href="#">Nos agences</a></li>
                    <li><a href="#">Recrutement</a></li>
                    <li><a href="#">Affiliation</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Conditions</h3>
                <ul>
                    <li><a href="#">CGV</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Paiement sécurisé</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Tel: 01 34 25 10 10</p>
                <p>Email: contact@xplore.com</p>
                <p>Av. du Parc, 95000 Cergy</p>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 XPlore - Tous droits réservés</p>
        </div>
    </footer>
    
</body>


</html>
