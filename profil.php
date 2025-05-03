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
    <link id="theme-style" rel="stylesheet" href="css/styleprofil.css">
    <script src="js/theme.js" defer></script>
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

    <div class="menu-redu">
     <a href="admin.php">Admin</a>
     <a href="index.php">Accueil</a>
     <a href="destination.php">Destination</a>
     <a href="profil.php">Mon Profil</a>
     <a href="inscription.php">Se connecter</a>
    </nav>
    </div>

    <h1 class="profil-title">Mon compte</h1>
    <?php if (isset($_GET['updated'])): ?>
    <p style="text-align:center; color:green;">✅ Modifications enregistrées.</p>
<?php endif; ?>


    <form method="POST" action="update_user.php">

<div class="profil-table-container">
<table class="profil-table">
  <!-- Pseudo -->
  <tr data-field="nickname">
    <td>Pseudo</td>
    <td><input class="editable-field" type="text" name="nickname" value="<?= htmlspecialchars($currentUser['personal_info']['nickname']) ?>" disabled></td>
    <td>
      <button type="button" class="edit-btn">Modifier</button>
      <button type="button" class="save-btn" style="display:none;">Valider</button>
      <button type="button" class="cancel-btn" style="display:none;">Annuler</button>
    </td>
  </tr>

  <!-- Nom complet -->
  <tr data-field="name">
    <td>Nom complet</td>
    <td><input class="editable-field" type="text" name="name" value="<?= htmlspecialchars($currentUser['personal_info']['name']) ?>" disabled></td>
    <td>
      <button type="button" class="edit-btn">Modifier</button>
      <button type="button" class="save-btn" style="display:none;">Valider</button>
      <button type="button" class="cancel-btn" style="display:none;">Annuler</button>
    </td>
  </tr>

  <!-- Email -->
  <tr data-field="email">
    <td>Email</td>
    <td><input class="editable-field" type="email" name="email" value="<?= htmlspecialchars($currentUser['email']) ?>" disabled></td>
    <td>
      <button type="button" class="edit-btn">Modifier</button>
      <button type="button" class="save-btn" style="display:none;">Valider</button>
      <button type="button" class="cancel-btn" style="display:none;">Annuler</button>
    </td>
  </tr>

  <!-- Adresse -->
  <tr data-field="address">
    <td>Adresse</td>
    <td><input class="editable-field" type="text" name="address" value="<?= htmlspecialchars($currentUser['personal_info']['address']) ?>" disabled></td>
    <td>
      <button type="button" class="edit-btn">Modifier</button>
      <button type="button" class="save-btn" style="display:none;">Valider</button>
      <button type="button" class="cancel-btn" style="display:none;">Annuler</button>
    </td>
  </tr>

  <!-- Non modifiables -->
  <tr><td>Date de naissance</td><td><?= htmlspecialchars($currentUser['personal_info']['birthdate']) ?></td><td></td></tr>
  <tr><td>Date d'inscription</td><td><?= htmlspecialchars($currentUser['registration_date']) ?></td><td></td></tr>
  <tr><td>Dernière connexion</td><td><?= htmlspecialchars($currentUser['last_login_date']) ?></td><td></td></tr>
</table>

<!-- Bouton global -->
<button id="btn-soumettre" type="button" style="display:none;">Soumettre les modifications</button>



<!-- Lien JS -->
<script src="js/profil.js"></script>
    </div>
</form>


<h2 class="profil-reserved-title">Mes voyages réservés :</h2>
<div class="trips-table-container">
<?php if (!empty($currentUser['trips_history'])): ?>
    <div class="trips-table-container" style="text-align:center;">
    <a href="recapprofil.php?index=0" class="trip-details-btn">Consulter mes voyages</a>
    <a href="panier.php" class="btn-panier">Voir mon panier</a>

    </div>
<?php else: ?>
    <p>Aucun voyage réservé pour l’instant.</p>
<?php endif; ?>



</div>
<div id="notif" style="display:none;"></div>

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

