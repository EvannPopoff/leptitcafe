<?php
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
require_once 'app/controllers/ImageCompression.php';

// On récupère la page demandée via l'URL sinon on met "home" par défaut.
$page = $_GET['page'] ?? 'home';

// On définit le chemin du dossier des pages directement pour plus de clarté et d'automatisation
$viewPath = 'app/views/pages/';
$layoutPath = 'app/views/layouts/';
// On construit le chemin complet du fichier à inclure.
$filePath = $viewPath . $page . '.php';

//  Intercepteurs (Traitement sans HTML) ---

// Pour intercepter le contrôleur de sauvegarde d'événement
if ($page === 'save-event') {
    require_once 'app/controllers/EventController.php';
    exit; 
}

// Pour intercepter le contrôleur de suppression d'événement
if ($page === 'delete-event') {
    require_once 'app/controllers/DeleteEventController.php';
    exit; 
}

// Pour intercepter l'envoi du formulaire de contact
if ($page === 'send-message') {
    require_once 'app/controllers/ContactController.php';
    exit;
}

// Marquer le message comme traité pour le message dashboard
if ($page === 'mark-message-treated') {
    if (isset($_POST['id_message'])) {
        // On récupère l'ID de l'admin en session (ou 1 par défaut pour le test)
        $id_admin = $_SESSION['user_id'] ?? 1; 
        
        $manager = new app\models\managers\MessageManager($db);
        $manager->markAsTreated((int)$_POST['id_message'], $id_admin);
    }
    
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
    exit;
}

// Pour intercepter la requête JSON des événements
if ($page === 'events-json') {
    if (file_exists($filePath)) {
        include $filePath;
        exit; 
    }
}

// Gestion des titres
$title = "Le P'tit Café";
if ($page === 'home') { $title = "Accueil - Le P'tit Café"; }
if ($page === 'membership') { $title = "Adhérer - Le P'tit Café"; }
if ($page === 'apropos') { $title = "À propos - Le P'tit Café"; }
if ($page === 'contact') { $title = "Contact - Le P'tit Café"; }
if ($page === 'evenement') { $title = "Activités et Évènements - Le P'tit Café"; }
if ($page === 'dashboard') { $title = "Dashboard Admin - Le P'tit Café"; } // Optionnel
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
        <?php if ($page === 'dashboard'): ?>
            <link rel="stylesheet" href="assets/css/admin-dashboard.css">
        <?php endif; ?>

        <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    </head>
    <body>

    <?php 
    // Système de layout : Header
    if ($page !== 'dashboard' && file_exists($layoutPath . 'header.php')) {
        include $layoutPath . 'header.php';
    }

    echo '<main>';

    if (file_exists($filePath)) {
        include $filePath;
    } else {
        include $viewPath . 'home.php';
    }

    echo '</main>';

    // Système de layout : Footer
    if ($page !== 'dashboard' && file_exists($layoutPath . 'footer.php')) {
        include $layoutPath . 'footer.php';
    }
    ?>

</body>
</html>