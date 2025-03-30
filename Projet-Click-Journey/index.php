
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xplore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/styleindex.css">
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
    </nav>
    </div>

    <section class="recherche">
        <div class="presentation">
            <h1>Vivez une aventure</h1>
            <p>Découvrez de merveilleuses places...</p>
            <div class="searchbox">
                <input type="text" class="search-input" placeholder="Where to">
                <input type="text" class="search-input" placeholder="Duration">
                <input type="text" class="search-input" placeholder="Search">
                <button class="search-btn">Search</button>
            </div>
        </div>
    </section>

 <!-- Destinations de Trek Populaires -->
 <section class="destinations">
    <h2>Treks Incontournables</h2>
    <div class="destination-container">
        <div class="destination" style="background-image: url('image/himalaya.jpg');">
            <h3>Himalaya, Népal</h3>
        </div>
        <div class="destination" style="background-image: url('image/patagonie.jpg');">
            <h3>Patagonie, Chili</h3>
        </div>
        <div class="destination" style="background-image: url('image/alpes.jpg');">
            <h3>Les Alpes, France</h3>
        </div>
    </div>
</section>

<!-- À Propos de Nous -->
<section class="about">
    <h2>À Propos de Nous</h2>
    <p>Passionnés de trekking et d’aventure, nous vous guidons vers les sentiers les plus époustouflants du monde. Que vous soyez débutant ou expert, nous avons l’expédition parfaite pour vous.</p>
</section>

<!-- Témoignages -->
<section class="testimonials">
    <h2>Avis de Trekkeurs</h2>
    <div class="testimonial-container">
        <div class="testimonial">
            <p>"Une aventure incroyable dans l’Himalaya ! Organisation et guides au top."</p>
            <h4>- Lucas P.</h4>
        </div>
        <div class="testimonial">
            <p>"Les paysages en Patagonie étaient à couper le souffle ! Merci pour cette expérience unique."</p>
            <h4>- Camille D.</h4>
        </div>
    </div>
</section>

<!-- Blog Trekking -->
<section class="blog">
    <h2>Conseils Trek & Aventure</h2>
    <div class="blog-container">
        <article>
            <h3>Comment bien préparer son sac de trek ?</h3>
            <p>Tout ce qu’il faut savoir pour randonner léger et efficace...</p>
        </article>
        <article>
            <h3>Les plus beaux treks du monde</h3>
            <p>Découvrez notre sélection des itinéraires de trekking incontournables...</p>
        </article>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter">
    <h2>Recevez nos Bons Plans Trek</h2>
    <form>
        <input type="email" placeholder="Votre email" required>
        <button type="submit">S'inscrire</button>
    </form>
</section>

<!-- Contact -->
<section class="contact">
    <h2>Contactez-nous</h2>
    <form>
        <input type="text" placeholder="Nom" required>
        <input type="email" placeholder="Email" required>
        <textarea placeholder="Votre message" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</section>
    



    

    <script>
        const MenuButton = document.querySelector('.menu-reduit')
        const MenuButtonICON = document.querySelector('.menu-reduit i')
        const Menu = document.querySelector('.menu-redu')

        MenuButton.onclick = function(){
            Menu.classList.toggle('open')
            const isOpen = Menu.classList.contains('open')
            MenuButtonICON.classList= isOpen ? 'fas fa-xmark':'fas fa-bars'
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