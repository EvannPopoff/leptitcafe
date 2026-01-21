<?php
use app\models\entities\Event;
use app\models\managers\EventManager;
use app\config\Database;

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::getInstance();
    $manager = new EventManager($db);

    // On récupère l'id qui existe déjà
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

    // Gestion de l'image (identique à ton code)
    $imageName = $_POST['old_image'] ?? null; 
    if (!empty($_FILES['image_event']['name'])) {
        $imageName = time() . '_' . str_replace(' ', '_', $_FILES['image_event']['name']);
        move_uploaded_file($_FILES['image_event']['tmp_name'], 'assets/images/events/' . $imageName);
    }

    // on prépare les données
    $data = [
        'id_evenement' => $id, // On injecte l'ID ici pour l'entité
        'titre' => $_POST['titre'],
        'description' => $_POST['description'] ?? null,
        'date_evenement' => $_POST['date_evenement'],
        'heure' => $_POST['heure'],
        'lieu' => $_POST['lieu'] ?? '',
        'type' => $_POST['type'] ?? null,
        'image_url' => $imageName,
        'mis_en_avant' => isset($_POST['mis_en_avant']) ? 1 : 0,
        'statut' => 1,
        'lien_programme_pdf' => null 
    ];

    $event = new Event($data);

    try {
        // la logique de bascule pour passer de create à update pour la maj
        if ($id) {
            // Si on a un ID, on appelle UPDATE
            if ($manager->update($event)) {
                echo json_encode(['status' => 'success', 'message' => 'L\'événement a été modifié !']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la modification.']);
            }
        } else {
            // Si pas d'ID, on appelle CREATE
            if ($manager->create($event, $_SESSION['admin_id'])) {
                echo json_encode(['status' => 'success', 'message' => 'Nouvel événement créé !']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la création.']);
            }
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit();
}