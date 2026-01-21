<?php
header('Content-Type: application/json');

use app\models\managers\EventManager;
use app\models\managers\SlotManager;
use app\config\Database;

$db = Database::getInstance();
$eventManager = new EventManager($db);
$slotManager = new SlotManager($db);

$events = $eventManager->findAll();
$blockedSlots = $slotManager->findBlockedSlots();

$fullCalendarData = [];

// 1. Événements normaux
foreach ($events as $event) {
    $fullCalendarData[] = [
        'id' => $event->getIdEvent(),
        'title' => $event->getTitle(),
        'start' => $event->getDateEvent() . 'T' . $event->getHour(),
        'extendedProps' => [
            'type' => 'event',
            'description' => $event->getDescription(),
            'place' => $event->getPlace(),
            'image_url' => $event->getImageUrl(),
            'top_event' => $event->isTopEvent()
        ]
    ];
}

// 2. Créneaux bloqués (Background)
foreach ($blockedSlots as $slot) {
    $fullCalendarData[] = [
        'id' => 'block_' . $slot['id_creneau'],
        'start' => $slot['date_creneau'] . 'T' . $slot['heure_debut'],
        'end' => $slot['date_creneau'] . 'T' . $slot['heure_fin'],
        'display' => 'background',
        'color' => '#d3d3d3', 
        'overlap' => false,
        'title' => $slot['motif_blocage']
    ];
}

echo json_encode($fullCalendarData);
exit();