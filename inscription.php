<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $nickname = htmlspecialchars($_POST['nickname'] ?? '');
        $birthdate = htmlspecialchars($_POST['birthdate'] ?? '');
        $address = htmlspecialchars($_POST['address'] ?? '');

        $usersFile = 'data/users.json';
        $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

        $exist = false;
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {

            $newUser = [
                "email" => $email,
                "password" => $password,
                "role" => "normal",
                "personal_info" => [
                    "name" => $nom,
                    "nickname" => $nickname,
                    "birthdate" => $birthdate,
                    "address" => $address
                ],
                "registration_date" => date("Y-m-d"),
                "last_login_date" => date("Y-m-d"),
                "trips_history" => []
            ];

            $users[] = $newUser;
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

            // ✅ Stockage sécurisé : seulement email et role dans la session
            $_SESSION['user'] = [
                'email' => $email,
                'role' => 'normal'
            ];

            header("Location: profil.php");
            exit();
        } else {
            $error = "Ce compte existe déjà.";
        }
    } else {
        $error = "Veuillez remplir les champs obligatoires.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription complète</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/styleinscription.css">
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

        <?php if (isset($_SESSION['email'])): ?>
            <a href="profil.php">Mon Profil</a>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion.php">Se connecter</a>
        <?php endif; ?>
</nav>

    
     
     

    </section>

    
    <div class="container">
        <form action="inscription.php" method="post" class="form-container">
            <h2>Créer un compte</h2>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>

            <!-- Champs obligatoires -->
            <input type="text" name="nom" placeholder="Nom complet *" required>
            <input type="email" name="email" placeholder="Email *" required>
            <input type="password" name="password" placeholder="Mot de passe *" required>

            <!-- Champs facultatifs -->
            <input type="text" name="nickname" placeholder="Pseudo (facultatif)">
            <label>Date de naissance (facultatif)</label>
            <input type="date" name="birthdate">
            <input type="text" name="address" placeholder="Adresse (facultatif)">

            <button type="submit">Créer mon compte</button>
            <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a></p>
        </form>
    </div>

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


