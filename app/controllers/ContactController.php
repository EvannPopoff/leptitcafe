<?php
use app\models\entities\Message;
use app\models\managers\MessageManager;
use app\config\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::getInstance();
    $manager = new MessageManager($db);

    // On combine Prénom et Nom pour la colonne 'nom'
    $nomComplet = htmlspecialchars($_POST['firstname'] . ' ' . $_POST['lastname']);

    $data = [
        'nom'       => $nomComplet,
        'email'     => htmlspecialchars($_POST['email']),
        'telephone' => htmlspecialchars($_POST['telephone'] ?? ''),
        'categorie' => htmlspecialchars($_POST['categorie']),
        'contenu'   => htmlspecialchars($_POST['contenu']),
        'statut'    => 0
    ];

    $message = new Message($data);

    if ($manager->create($message)) {
        // REDIRECTION : On renvoie vers la page contact avec un flag de succès
        header('Location: index.php?page=contact&res=success');
    } else {
        header('Location: index.php?page=contact&res=error');
    }
    exit;
}