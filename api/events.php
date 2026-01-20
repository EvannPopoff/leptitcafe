<?php

header('Content-Type: application/json; charset=utf-8'); // JSON encodé en UTF 8, obligatoire pour une api. C'est mieux d'utiliser du JSON car c'est mieux pour le green coding

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // à partir de quel événement on commence
$limit  = isset($_GET['limit']) ? (int)$_GET['limit'] : 2; // combien d’événements on renvoie

// Données sans BDD
$events = [
  ["title" => "Événement 1", "image" => "assets/images/page_home_evenements/event1.avif"],
  ["title" => "Événement 2", "image" => "assets/images/page_home_evenements/event2.avif"],
  ["title" => "Événement 3", "image" => "assets/images/page_home_evenements/event3.webp"],
  ["title" => "Événement 4", "image" => "assets/images/page_home_evenements/event4.webp", "url" => "index.php?page=apropos"],
  ["title" => "Événement 5", "image" => "assets/images/page_home_evenements/event5.webp", "url" => "index.php?page=apropos"],
];

$items = array_slice($events, $offset, $limit); //array_slide coupe le tableau et renvoie une portion du tableau de données (offset et limlt cf ligne 5/6)
$hasMore = ($offset + $limit) < count($events); //reste des éléments après ceux qui ont été envoyé - 
//offset + limit = jusqu'à quel event on va / count event = nbre total d'events.

//charger les éléments JSON (Chat GPT)
echo json_encode([
  "items" => $items,
  "hasMore" => $hasMore
], JSON_UNESCAPED_SLASHES);

?>