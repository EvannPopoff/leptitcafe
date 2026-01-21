<?php
use app\models\entities\Event;
use app\models\managers\EventManager;
use app\config\Database;

// On précise au navigateur qu'on va répondre en JSON pour utiliser AJAX
header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée, veuillez vous reconnecter.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::getInstance();
    $manager = new EventManager($db);

    // Upload de l'image
    $imageName = null;
    if (!empty($_FILES['image_event']['name'])) {
        $cleanName = str_replace(' ', '_', $_FILES['image_event']['name']);
        $imageName = time() . '_' . $cleanName;
        move_uploaded_file($_FILES['image_event']['tmp_name'], 'assets/images/events/' . $imageName);
    }

    // Création de l'objet
    $event = new Event([
        'titre'              => $_POST['titre'],
        'description'        => $_POST['description'] ?? null,
        'date_evenement'     => $_POST['date_evenement'],
        'heure'              => $_POST['heure'],
        'lieu'               => $_POST['lieu'] ?? '',
        'type'               => $_POST['type'] ?? null, 
        'image_url'          => $imageName,
        'mis_en_avant'       => isset($_POST['mis_en_avant']) ? 1 : 0,
        'statut'             => 1,
        'lien_programme_pdf' => null 
    ]);

    try {
        // Insertion
        if ($manager->create($event, $_SESSION['admin_id'])) {
            // RÉPONSE DE SUCCÈS
            echo json_encode([
                'status' => 'success', 
                'message' => 'L\'événement "' . htmlspecialchars($event->getTitle()) . '" a été ajouté avec succès !'
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Impossible d\'enregistrer l\'événement.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erreur SQL : ' . $e->getMessage()]);
    }
    exit(); // On arrête tout ici pour ne pas envoyer de HTML par erreur

    $id = $_POST['id'] ?? null;

    $event = new Event($_POST);

    if ($id) {
        $event->setIdEvent((int)$id);
        $result = $manager->update($event);
        $message = "Événement modifié !";
    }
        
        else {
        $result = $manager->create($event, $_SESSION['admin_id']);
        $message = "Événement créé !";
    }

echo json_encode(['status' => ($result ? 'success' : 'error'), 'message' => $message]);
}