<?php

use app\models\managers\EventManager;
use app\config\Database;

header('Content-Type: application/json');

// on vérifie que l'admin est connecté comme d'hab
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
            
            // Pour la suppression d'un événement donc de son image dans le dossier "events"
            // On récup l'événement pour savoir s'il a une image
            $event = $manager->findById($id);

            if ($event) {
                // Si on a une image enregistrée, on va essayer de la supprimer du serveur
                $imageName = $event->getImageUrl();
                if ($imageName) {
                    $filePath = 'assets/images/events/' . $imageName;
                    
                    // on vérifie si le fichier existe vraiment avant de tenter de le supprimer
                    if (file_exists($filePath)) {
                        unlink($filePath); // on supprime le fichier physique
                    }
                }

                // 3. Suppression en BDD
                if ($manager->delete($id)) {
                    echo json_encode(['status' => 'success', 'message' => 'Événement et image supprimés avec succès !']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Impossible de supprimer l\'événement en base de données.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Événement introuvable.']);
            }

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID d\'événement non valide.']);
    }
}
exit;