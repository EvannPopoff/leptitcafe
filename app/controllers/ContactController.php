<?php
use app\models\entities\Message;
use app\models\managers\MessageManager;
use app\config\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = Database::getInstance();
        $manager = new MessageManager($db);

        // Préparation des données pour la table MESSAGES
        $data = [
            'nom'       => $_POST['firstname'] . ' ' . $_POST['lastname'],
            'email'     => $_POST['email'],
            'telephone' => $_POST['telephone'] ?? null,
            'categorie' => $_POST['categorie'],
            'contenu'   => $_POST['contenu'],
            'statut'    => 0
        ];

        $message = new Message($data);

        if ($manager->create($message)) {
            // Succès : on redirige vers la page contact avec un paramètre success
            header('Location: index.php?page=contact&res=success');
        } else {
            // Erreur technique
            header('Location: index.php?page=contact&res=error&msg=db_error');
        }
    } catch (Exception $e) {
        // Exception
        header('Location: index.php?page=contact&res=error&msg=' . urlencode($e->getMessage()));
    }
    exit;
}