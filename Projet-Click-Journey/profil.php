<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['email'])) {
    header('Location: connexion.php');
    exit();
}

// Chargement des utilisateurs
$usersFile = 'data/users.json';
$users = json_decode(file_get_contents($usersFile), true);

// Recherche de l'utilisateur connecté dans le fichier JSON
$currentUserEmail = $_SESSION['user']['email'];
$currentUser = null;
foreach ($users as $user) {
    if (isset($user['email']) && $user['email'] === $currentUserEmail) {
        $currentUser = $user;
        break;
    }
}

// Si on ne retrouve pas l'utilisateur (email supprimé, par ex)
if (!$currentUser) {
    session_destroy();
    header('Location: connexion.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/styleprofil.css">
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
        <a href="profil.php">Mon Profil</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion.php">Se connecter</a>
        <?php endif; ?>
</nav>


     <div class="menu-reduit" id="menu-reduit"><i class="fas fa-bars"></i></div>

     
     

    </section>

    <h1 class="profil-title">Mon compte</h1>
<div class="profil-table-container">
    <table class="profil-table">
        <tr><th>Nom complet</th><td><?= htmlspecialchars($currentUser['personal_info']['name'] ?? '') ?></td></tr>
        <tr><th>Pseudo</th><td><?= htmlspecialchars($currentUser['personal_info']['nickname'] ?? '') ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($currentUser['email'] ?? '') ?></td></tr>
        <tr><th>Date de naissance</th><td><?= htmlspecialchars($currentUser['personal_info']['birthdate'] ?? '') ?></td></tr>
        <tr><th>Adresse</th><td><?= htmlspecialchars($currentUser['personal_info']['address'] ?? '') ?></td></tr>
        <tr><th>Date d'inscription</th><td><?= htmlspecialchars($currentUser['registration_date'] ?? '') ?></td></tr>
        <tr><th>Dernière connexion</th><td><?= htmlspecialchars($currentUser['last_login_date'] ?? '') ?></td></tr>
    </table>
</div>

<h2 class="profil-reserved-title">Mes voyages réservés :</h2>
<div class="trips-table-container">
<?php if (!empty($currentUser['trips_history'])): ?>
    <table class="trips-table">
        <thead><tr><th>Nom du voyage</th></tr></thead>
        <tbody>
            <?php foreach ($currentUser['trips_history'] as $index => $trip): ?>
                <?php if (is_array($trip)): ?>
                    <td>
                    <span><?= htmlspecialchars($trip['title'] ?? 'Voyage personnalisé') ?></span>
                    <form method="post" action="recapitulatif.php" style="display:inline; margin-left: 20px;">
                        <input type="hidden" name="recap_data" value='<?= htmlspecialchars(json_encode($trip), ENT_QUOTES, "UTF-8") ?>'>
                        <button type="submit" class="trip-details-btn">Voir les détails</button>
                    </form>
                    </td></tr>
                <?php else: ?>
                    <tr><td><?= htmlspecialchars($trip) ?></td></tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun voyage réservé pour l’instant.</p>
<?php endif; ?>



</div>
</body>
</html>



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

