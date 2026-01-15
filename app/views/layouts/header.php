<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Header</title>

        <script src="assets/js/header.js"></script>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
        <header> 
            <div class="in-header">
                <!-- Logo -->
                <a class="logo" href="index.php">
                    <img src="assets/images/logo.webp" alt="logo">
                </a>    

                <nav class="main-nav">
                    <ul>
                        <li><a href="app/views/pages/apropos.php">À propos</a></li>
                        <li><a href="apropos.php">À propos</a></li>
                        <li><a href="">Activités et Évènements</a></li>
                        <li><a href="">Adhérer</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </nav>

                <a class="bouton-reservation" href="">Réservation</a>

                <!-- Menu Burger-->
                <button class="burger-bouton" type="button">
                    <img src="assets/images/Burger.png" alt="menu-burger">
                </button>
            </div>

            <div class="mobile-menu">
                <button class="close-bouton" type="button" aria-label="Fermer le menu">
                <img src="assets/images/Close Burger.png" alt="close-burger">
                </button>
            </div>

        </header>
    </body>

</html>