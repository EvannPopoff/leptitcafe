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
    "text" => "En décembre et pour le 5ème édition, les associations Jeunes Pousses et Vivre en Vieille en Ville, 
    se mobilisent pour vous proposer un événement culturel et artistique quotidien : En attendant Noël, le Calendrier de l'Après !
    A partir du 1er décembre, venez découvrir l'artiste surprise qui jouera à la fenêtre du p'tit Café,
    tous les soirs de décembre, de 18h30 à 19h. Musique, contes, théâtre, danse, lectures, et bien d'autres surprises vous attendent, vous ne serez
    pas déçus par les artistes locaux !
    Rendez-vous donc, autour d’un vin chaud ou d’un « pomme-chaud »,
    25 place du marché couvert, au Puy-en-Velay, pour un mois de décembre rempli de découvertes culturelles et artistiques."
  ],

  [
    "id" => 2,
    "title" => "Festin Nomade",
    "image" => "assets/images/page_home_evenements/event2.avif",
    "text" => "Une journée festive et familiale autour de la cuisine et de la rencontre.
    Au programme : 11h – 12h30 | Discussions gourmandes
    L’émission radio MFM – Menu Festin Massif, en partenariat avec l’Étonnant Festin, sera diffusée en direct du marché du Puy. Producteurs, restaurateurs, associations, auteurs et élus engagés pour une alimentation de qualité et accessible échangeront autour de la gastronomie locale.
    12h – 14h | Découvertes culinaires
    À l’heure du déjeuner, plusieurs restaurateurs du Puy proposeront des plats inspirés de cahiers de recettes familiales. Le public pourra librement choisir le menu qu’il souhaite découvrir parmi les établissements participants.
    14h – 18h | Animations familiales
    Sur la place du Marché Couvert, des ateliers ludiques et créatifs autour de l’alimentation seront proposés : sac à vrac, instruments en légumes, peinture végétale, jeux, espace enfants et personnalisation de cahiers de recettes."
  ],


  [
    "id" => 3,
    "title" => "Quinzaine des Droits de l'Enfant",
    "image" => "assets/images/page_home_evenements/event3.webp",
    "text" => "Crée à l'automne 2012 par l'association Jeunes Pousses, cette manifestation annuelle a pour but de mettre en lumière les droits de l'enfant auprès du grand public et de concentrer les membres de l'association sur ce thème durant sa préparation et son déroulement. L'objectif est d'en profiter pour ouvrir notre regard sur différentes pratiques et actions éducatives, de créer un débat, une réflexion mais aussi de tester des outils, tout cela dans le non-jugement, la bienveillance.


      Concrètement cela se traduit selon les années par des spectacles, des expositions, des projections, des ateliers parents-enfants, des temps d'échanges entre adultes... La thématique peut ainsi être abordée sous différents angles entre adultes ou en famille, toujours dans un esprit convivial, sans oublier des temps festifs.
      En 2012, nous avons abordé les droits des enfants dans leur globalité.
      En 2013, nous avons mis en lumière la personne et l'Oeuvre de Janusz Korczak, inspirateur de la convention international des Droits de l'Enfant
      En 2014, le droit à l'expression : « Ecoute-moi quand je te parle ! »
      En 2015, le droit d'être protégé face à toutes sortes de violences : Vivre heureux en famille ?
      En 2016, le droit à la paix à différente échelle mondiale, familiale : La Paix en famille
      Du 1er au 18 novembre 2017, la dernière édition de la Quinzaine des Droits de l'Enfant : Rire à Tout Va"
  ],


  [
    "id" => 4,
    "title" => "Pas de Plaisir sans Consentement !",
    "image" => "assets/images/page_home_evenements/event4.webp",
    "text" => "Au programme composé de conférences, ateliers, débats  pour nous accompagner, nous individus, parents, enfants à pouvoir échanger autour de la thématique de la sexualité car il n’y a « pas de plaisir sans consentement » et éveiller une conscience propre à prévenir les comportements abusifs.
    Pour tous les ateliers, conférences ... inscriptions au 07.78.68.53.37 ou cafejeunespousses@gmail.com
    sauf pour le cycloshow et mission xy directement en ligne"
  ],


  [
    "id" => 5,
    "title" => "Le Printemps Indien de l'Education",
    "image" => "assets/images/page_home_evenements/event5.webp",
    "text" => "Un véritable phénomène d'éclosion d'initiatives est en train de se mettre en place dans l'éducation pour (r)éveiller le goût d'apprendre aux élèves.
    De plus en plus d'enseignants se forment à de nouvelles pédagogies plus respectueuses du rythme d'apprentissage, des conditions d'entrée dans le savoir et de gestion des émotions de leurs élèves. De plus en plus de parents s'interrogent sur le bien-être de leurs enfants à l'école.
    L'association Jeunes Pousses souhaite participer à ce débat de société par la création de temps d'échanges et de rencontres entre professionnels de milieu de l'enseignement et familles, en permettant à chacun de se réapproprier la question de l'école et des apprentissages."
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