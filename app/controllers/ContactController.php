<?php
use app\models\entities\Message;
use app\models\managers\MessageManager;
use app\config\Database;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = Database::getInstance();
        $manager = new MessageManager($db);

        // On prépare les données pour l'entité
        $data = [
            'nom'       => $_POST['firstname'] . ' ' . $_POST['lastname'],
            'email'     => $_POST['email'],
            'telephone' => $_POST['telephone'] ?? null,
            'categorie' => $_POST['categorie'],
            'contenu'   => $_POST['contenu'],
            'statut'    => 0 // 0 = Nouveau message
        ];

        $message = new Message($data);

        if ($manager->create($message)) {
            echo json_encode(['status' => 'success', 'message' => 'Merci ! Votre message a bien été envoyé.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'enregistrement en base de données.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;

}