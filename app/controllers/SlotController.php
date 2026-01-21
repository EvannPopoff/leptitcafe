<?php
use app\models\managers\SlotManager;
use app\config\Database;

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = Database::getInstance();
        $manager = new SlotManager($db);
        
        if ($manager->blockSlot($_POST, $_SESSION['admin_id'])) {
            echo json_encode(['status' => 'success', 'message' => 'Le créneau a été verrouillé !']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors du blocage.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}