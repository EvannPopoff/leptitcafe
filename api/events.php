<?php

header('Content-Type: application/json; charset=utf-8'); // JSON encodé en UTF 8, obligatoire pour une api. C'est mieux d'utiliser du JSON car c'est mieux pour le green coding

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // à partir de quel événement on commence
$limit  = isset($_GET['limit']) ? (int)$_GET['limit'] : 2; // combien d’événements on renvoie

// Données sans BDD
$events = [
  [
    "id" => 1,
    "title" => "Calendrier de L'Après",
    "image" => "assets/images/page_home_evenements/event1.avif",
    "text" => "Une programmation culturelle et artistique offerte pendant les 24 jours avant Noël."
  ],
  [
    "id" => 2,
    "title" => "Festin Nomade",
    "image" => "assets/images/page_home_evenements/event2.avif",
    "text" => "Une journée festive et familiale autour de la cuisine et de la rencontre."
  ],
  [
    "id" => 3,
    "title" => "Quinzaine des Droits de l'Enfant",
    "image" => "assets/images/page_home_evenements/event3.webp",
    "text" => "Ateliers, échanges et temps forts pour sensibiliser aux droits de l’enfant."
  ],
  [
    "id" => 4,
    "title" => "Pas de Plaisir sans Consentement !",
    "image" => "assets/images/page_home_evenements/event4.webp",
    "text" => "Films, débats et ateliers pour ouvrir la discussion autour du consentement."
  ],
  [
    "id" => 5,
    "title" => "Le Printemps Indien de l'Education",
    "image" => "assets/images/page_home_evenements/event5.webp",
    "text" => "Un événement pour mettre en lumière des initiatives éducatives locales."
  ],
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id !== null) {
  foreach ($events as $event) {
    if ((int)$event["id"] === $id) {
      echo json_encode($event, JSON_UNESCAPED_SLASHES);
      exit;
    }
  }

  // si on ne trouve pas l'event
  http_response_code(404);
  echo json_encode(["error" => "Event not found"]);
  exit;
}

$items = array_slice($events, $offset, $limit); //array_slide coupe le tableau et renvoie une portion du tableau de données (offset et limlt cf ligne 5/6)
$hasMore = ($offset + $limit) < count($events); //reste des éléments après ceux qui ont été envoyé - 
//offset + limit = jusqu'à quel event on va / count event = nbre total d'events.

//charger les éléments JSON (Chat GPT)
echo json_encode([
  "items" => $items,
  "hasMore" => $hasMore
], JSON_UNESCAPED_SLASHES);

?>