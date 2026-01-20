<?php

use app\models\entities\Event;
use app\models\managers\EventManager;
use app\config\Database;

// Comme d'habitude, on vérifie que l'utilisateur est bien connecté en tant qu'admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php?page=login');
    exit();
}

// On vérifie qu'on arrive bien d'un formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On récupère la connexion à la BDD et le manager
    $db = Database::getInstance();
    $manager = new EventManager($db);

    // Traitement de l'image uploadée
    $imageUrl = null;
    if (!empty($_FILES['image_event']['name'])) {
        $imageName = time() . '_' . ($_FILES['image_event']['name']);
        move_uploaded_file($_FILES['image_event']['tmp_name'], 'assets/images/events/' . $imageName);

    }

    // Création de l'objet Event
    $event = new Event([
    'title' => $_POST['titre'],
    'description' => $_POST['description'],
    'date_event' => $_POST['date_evenement'],
    'hour' => $_POST['heure'],
    'place' => $_POST['lieu'],
    'type' => $_POST['type'],
    'image_url' => $_POST['image_url'],
    'top_event' => isset($_POST['mis_en_avant']) ? true : false,
    'statut'=> true, // Par défaut, l'événement est actif
    'prog_url' => $_POST['lien_programme_pdf'],
    ]);

    // On utilise le manager pour sauvegarder l'événement
    if ($manager->create($event, $_SESSION['admin_id'])) {
        // Succès
        header('Location: index.php?page=event-management&success=1');
    } else {
        // Échec
        header('Location: index.php?page=event-management&error=1');
    }
    exit();
   
}