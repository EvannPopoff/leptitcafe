<?php
// test erreur
ini_set('display_errors', 1);
error_reporting(E_ALL);

use app\models\entities\Event;
use app\models\managers\EventManager;
use app\config\Database;

// Vérification de la session admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php?page=login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $db = Database::getInstance();
    $manager = new EventManager($db);

    // Gestion de l'image
    $imageName = null;
    if (!empty($_FILES['image_event']['name'])) {
        $imageName = time() . '_' . $_FILES['image_event']['name'];
        // On s'assure que le chemin est correct pour Hostinger
        move_uploaded_file($_FILES['image_event']['tmp_name'], 'assets/images/events/' . $imageName);
    }

    // Création de l'objet Event
    // Les clés à gauche correspondent au constructeur.
    $event = new Event([
        'id_evenement'       => null,
        'titre'              => $_POST['titre'],
        'description'        => $_POST['description'] ?? null,
        'date_evenement'     => $_POST['date_evenement'],
        'heure'              => $_POST['heure'],
        'lieu'               => $_POST['lieu'] ?? '',
        'type'               => null, // Pas encore dans le formulaire
        'image_url'          => $imageName,
        'mis_en_avant'       => isset($_POST['mis_en_avant']) ? 1 : 0,
        'statut'             => 1,
        'lien_programme_pdf' => null 
    ]);

    // 3. Appel du Manager pour insérer l'événement
    try {
        if ($manager->create($event)) {
            header('Location: index.php?page=dashboard&success=1');
            exit();
        } else {
            echo "Le manager a retourné une erreur.";
        }
    } catch (Exception $e) {
        die("Erreur fatale lors de l'insertion : " . $e->getMessage());
    }
}