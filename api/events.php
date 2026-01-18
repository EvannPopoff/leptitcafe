<?php
header('Content-Type: application/json; charset=utf-8');

// Sécurité : offset/limit propres
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit  = isset($_GET['limit']) ? (int)$_GET['limit'] : 2;

if ($offset < 0) $offset = 0;
if ($limit < 1) $limit = 1;
if ($limit > 6) $limit = 6; // évite les abus

// Données (sans BDD) : tu peux changer les images/alt
$events = [
  ["title" => "Événement 1", "image" => "assets/images/event1.avif"],
  ["title" => "Événement 2", "image" => "assets/images/event2.avif"],
  ["title" => "Événement 3", "image" => "assets/images/event3.avif"],
  ["title" => "Événement 4", "image" => "assets/images/event4.png"],
  ["title" => "Événement 5", "image" => "assets/images/event5.png"],
];

$items = array_slice($events, $offset, $limit);
$hasMore = ($offset + $limit) < count($events);

echo json_encode([
  "items" => $items,
  "hasMore" => $hasMore
], JSON_UNESCAPED_SLASHES);

?>