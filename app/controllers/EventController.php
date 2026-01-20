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
    $db = Database::getInstance();
    $manager = new EventManager($db);

    // Gestion de l'image
    $imageName = null;
    if (!empty($_FILES['image_event']['name'])) {
        $imageName = time() . '_' . $_FILES['image_event']['name'];
        move_uploaded_file($_FILES['image_event']['tmp_name'], 'assets/images/events/' . $imageName);
    }
    // Création de l'objet Event
    $event = new Event([
        'titre'              => $_POST['titre'],
        'description'        => $_POST['description'] ?? null,
        'date_evenement'     => $_POST['date_evenement'],
        'heure'              => $_POST['heure'],
        'lieu'               => $_POST['lieu'] ?? '',
        'type'               => null, 
        'image_url'          => $imageName,
        'mis_en_avant'       => isset($_POST['mis_en_avant']) ? 1 : 0,
        'statut'             => 1,
        'lien_programme_pdf' => null 
    ]);

    if ($manager->create($event)) {
        header('Location: index.php?page=dashboard&success=1');
    } else {
        header('Location: index.php?page=event-management&error=1');
    }
    exit();
}