<?php
use app\models\entities\Event;
use app\models\managers\EventManager;
use app\config\Database;
use app\controllers\ImageCompression; // On pointe sur la classe dans le même dossier

header('Content-Type: application/json');

// on vérifie que l'admin est connecté comme d'hab pour éviter les petits mâlins
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::getInstance();
    $manager = new EventManager($db);
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

    // On récupère le nom de l'ancienne image si elle existe
    $imageName = $_POST['old_image'] ?? null; 

    // Si une nouvelle image est envoyée
    if (!empty($_FILES['image_event']['tmp_name'])) {
        
        $newImageName = time() . '.jpg'; 
        $destination = 'assets/images/events/' . $newImageName;

        // On compresse la nouvelle image
        $success = ImageCompression::compressImage($_FILES['image_event']['tmp_name'], $destination);
        
        if ($success) {
            // Nettoyage du dossier
            // Si c'est une modification et qu'on avait déjà une image avant
            if ($id && !empty($_POST['old_image'])) {
                $oldFilePath = 'assets/images/events/' . $_POST['old_image'];
                
                // On supprime l'ancien fichier pour ne pas encombrer le serveur
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            // On met à jour le nom pour la base de données avec la nouvelle image
            $imageName = $newImageName;
        } else {
            // si la compression foire, on garde l'ancienne par sécurité
            $imageName = $_POST['old_image'] ?? null;
        }
    }

    // on prépare les données pour l'entité
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