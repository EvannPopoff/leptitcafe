<?php
use app\models\entities\Event;
use app\models\managers\EventManager;
use app\config\Database;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::getInstance();
    $manager = new EventManager($db);
    $id = $_POST['id'] ?? null;

    $imageName = $_POST['old_image'] ?? null; // Gestion d'image simplifiée pour l'exemple
    if (!empty($_FILES['image_event']['name'])) {
        $imageName = time() . '_' . $_FILES['image_event']['name'];
        move_uploaded_file($_FILES['image_event']['tmp_name'], 'assets/images/events/' . $imageName);
    }

    $event = new Event($_POST);
    if ($imageName) $event = new Event(array_merge($_POST, ['image_url' => $imageName]));

    try {
        if ($id) {
            $event->setIdEvent((int)$id);
            $res = $manager->update($event);
        } else {
            $res = $manager->create($event, $_SESSION['admin_id']);
        }

        echo json_encode(['status' => 'success', 'message' => 'Opération réussie !']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit();
}