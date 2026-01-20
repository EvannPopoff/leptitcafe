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
        $imageName = time() . '_' . $_FILES['image_event']['name'];
        move_uploaded_file($_FILES['image_event']['tmp_name'], 'assets/images/events/' . $imageName);

    }

    // Création de l'objet Event
    $event = new Event([
    'id_evenement' => null, // ID auto-incrémenté
    'titre' => $_POST['titre'],
    'description' => $_POST['description'],
    'date_evenement' => $_POST['date_evenement'],
    'heure' => $_POST['heure'],
    'lieu' => $_POST['lieu'],
    'type' => null, // A modifier quand crée
    'image_url' => $imageName,
    'mis_en_avant' => isset($_POST['mis_en_avant']) ? 1 : 0,
    'statut'=> 1, // Par défaut, l'événement est actif
    'lien_programme_pdf' => null, // Pareil, pas encore implémenté
    ]);

    // On utilise le manager pour sauvegarder l'événement
// Dans EventController.php, remplace le bloc "if ($manager->create...)" par :
try {
    $result = $manager->create($event, $_SESSION['admin_id']);
    if ($result) {
        header('Location: index.php?page=dashboard&success=1');
        exit();
    }
} catch (Exception $e) {
    die("Erreur SQL : " . $e->getMessage());
    }

}