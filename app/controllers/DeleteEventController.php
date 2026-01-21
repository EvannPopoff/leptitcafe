<?php
use app\models\managers\EventManager;
use app\config\Database;

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID d\'événement invalide.']);
        exit();
    }

    try {
        $db = Database::getInstance();
        $manager = new EventManager($db);
        
        if ($manager->delete($id)) {
            echo json_encode(['status' => 'success', 'message' => 'L\'événement a été supprimé !']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la suppression en base de données.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit();
}