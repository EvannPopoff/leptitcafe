<?php
use app\models\entities\Event;
use app\models\managers\EventManager;
use app\config\Database;
use app\controllers\ImageCompression; // On pointe sur la classe dans le même dossier

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::getInstance();
    $manager = new EventManager($db);
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

    $imageName = $_POST['old_image'] ?? null; 

    // ATTENTION : vérifie bien que ton HTML a name="image_event"
    if (!empty($_FILES['image_event']['tmp_name'])) {
        $imageName = time() . '.jpg'; 
        $destination = 'assets/images/events/' . $imageName;

        // On appelle la classe ImageCompression
        $success = ImageCompression::compressImage($_FILES['image_event']['tmp_name'], $destination);
        
        if (!$success) {
            $imageName = $_POST['old_image'] ?? null;
        }
    }

    // Préparation des données...
    $data = [
        'id_evenement' => $id, 
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
        if ($id) {
            if ($manager->update($event)) {
                echo json_encode(['status' => 'success', 'message' => 'L\'événement a été modifié !']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la modification.']);
            }
        } else {
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