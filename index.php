<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// On lance la session directement
session_start();

// On charge l'outil de connexion à la base de données pour toutes les pages et les récupérer.
require_once 'app/config/database.php';

// On charge les models (managers et entities)
require_once 'app/models/entities/Administrateur.php';
require_once 'app/models/managers/AdministrateurManager.php';
require_once 'app/models/entities/Event.php';
require_once 'app/models/managers/EventManager.php';
require_once 'app/models/managers/MessageManager.php';
require_once 'app/models/entities/Message.php';

// On charge les controllers.
require_once 'app/controllers/AuthController.php';

// On récupère la page demandée via l'URL sinon on met "home" par défaut.
$page = $_GET['page'] ?? 'home';

// On définit le chemin du dossier des pages directement pour plus de clarté et d'automatisation
$viewPath = 'app/views/pages/';
$layoutPath = 'app/views/layouts/';
// On construit le chemin complet du fichier à inclure.
$filePath = $viewPath . $page . '.php';

// Pour intercepter le contrôleur de sauvegarde d'événement avant le système de template mis en place.
if ($page === 'save-event') {
    require_once 'app/controllers/EventController.php';
    exit; // Pas de HTML, pas de Header, juste le traitement
}
// Pour intercepter le contrôleur de suppresion d'événement avant le système de template mis en place.
if ($page === 'delete-event') {
    require_once 'app/controllers/DeleteEventController.php';
    exit; 
}

if ($page === 'send-message') {
    require_once 'app/controllers/ContactController.php';
    exit;
}

// Pour intercepter la requête JSON avant le système de template mis en place.
if ($page === 'events-json') {
    if (file_exists($filePath)) {
        include $filePath;
        exit; // Pas de HTML, pas de Header, juste le JSON
    }
}

//Nom des pages
$title = "Le P'tit Café";
if ($page === 'home') { $title = "Accueil - Le P'tit Café"; }
if ($page === 'membership') { $title = "Adhérer - Le P'tit Café"; }
if ($page === 'apropos') { $title = "À propos - Le P'tit Café"; }
if ($page === 'contact') { $title = "Contact - Le P'tit Café"; }
if ($page === 'evenement') { $title = "Activités et Évènements - Le P'tit Café"; }

if ($page === 'confidentialite') { $title = "Politique de Confidentialité - Le P'tit Café"; }
if ($page === 'mentions') { $title = "Mentions Légales - Le P'tit Café"; }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="assets/css/style.css?v=1.1">
        <link rel="stylesheet" href="assets/css/calendar.css">

        <link rel="icon" type="image/png" href="/assets/images/favicon.png">

        </head>
        <body>

   <?php 
   // Ici c'est le système de layout général (footer + header pour la majorité des pages.
   // Cela évite de devoir le marquer 10 000 fois à chaque nouvelle page
   //  On exclut le header et le footer du dashboard admin
   if ($page !== 'dashboard' && file_exists($layoutPath . 'header.php')) {
        include $layoutPath . 'header.php';
    }

    // On ouvre la balise main car c'est la partie principale du système
    echo '<main>';

    if (file_exists($filePath)) {
        include $filePath;
    } else {
        // Si le fichier n'existe pas, on affiche le home
        include $viewPath . 'home.php';
    }

    echo '</main>';

    // On n'inclut le footer QUE si ce n'est pas le dashboard
    if ($page !== 'dashboard' && file_exists($layoutPath . 'footer.php')) {
        include $layoutPath . 'footer.php';
    }
   ?>

</body>
</html>