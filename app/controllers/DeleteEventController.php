<?php

use app\models\managers\EventManager;
use app\config\Database;

header('Content-Type: application/json');

// on vérifie que l'admin est connecté
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée.']);
    exit;
}

// Vérification de l'ID
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

    if ($id) {
        try {
            $db = Database::getInstance();
            $manager = new EventManager($db);
            
            if ($manager->delete($id)) {
                echo json_encode(['status' => 'success', 'message' => 'Événement supprimé avec succès !']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Impossible de supprimer l\'événement en base de données.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID d\'événement non valide.']);
    }
}
exit;