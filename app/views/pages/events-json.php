<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Fichier JSON indispensable pour faire communiquer le PHP et JavaScript pour le calendrier.

// On dit au navigateur que le contenu est du JSON
header('Content-Type: application/json');

// On inclut le fichier de configuration et de connexion à la base de données
use app\models\managers\EventManager;
use app\config\Database;

// On récupère la connexion de la BDD et du manager qu'on a crée
$db = Database::getInstance();
$manager = new EventManager($db);

// On récupère tous les événements
$events = $manager->findAll();

// On crée un tableau pour stocker les événements formatés
$fullCalendarEvents = [];

// On transforme chaque événement pour le format attendu par FullCalendar. Je le mets ici pour la lisibilité en dessous.
foreach  ($events as $event) {
    $start = $event->getDateEvent() . 'T' . $event->getHour();

// IL faut également d'après la doc, combiner la date et l'heure en un seul champ pour le format "start" de FullCalendar : YYYY-MM-DDTHH:MM:SS
    $fullCalendarEvents[] = [
        'id' => $event->getIdEvent(),
        'title' => $event->getTitle(),
        'start' => $start,
        'description' => $event->getDescription(),

        'extendedProps' => [
        // On peut ajouter des données personnalisées sur le calendrier pour la personnalisation
        'place' => $event->getPlace(),
        'type' => $event->getType(),
        'image_url' => $event->getImageUrl(),
        'top_event' => $event->isTopEvent(),
        'prog_url' => $event->getProgUrl(),
        'statut' => $event->isStatut(),
     ]

    ];
}

echo json_encode($fullCalendarEvents);
exit();
?>