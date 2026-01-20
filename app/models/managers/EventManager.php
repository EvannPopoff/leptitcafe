<?php
namespace app\models\managers;
use app\models\entities\Event;
use PDO;

class EventManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findAll(): array {
        $sql = "SELECT * FROM EVENEMENT ORDER BY date_evenement ASC, heure ASC";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $events = [];
        foreach ($results as $data) {
            // Tableau $data qui contient les clés id_evenement, titre, etc, que le constructeur gère.
            $events[] = new Event($data);
        }
        return $events;
    }

    public function findById(int $id): ?Event {
        $sql = "SELECT * FROM EVENEMENT WHERE id_evenement = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Event($data) : null;
    }

    public function create(Event $event): bool {
    // Requête basée sur ta capture d'écran SQL (10 colonnes à insérer)
    $sql = "INSERT INTO EVENEMENT (titre, description, date_evenement, heure, lieu, type, image_url, mis_en_avant, statut, lien_programme_pdf) 
            VALUES (:titre, :description, :date_evenement, :heure, :lieu, :type, :image_url, :mis_en_avant, :statut, :lien_programme_pdf)";
    
    $stmt = $this->db->prepare($sql);
    
    // On lie chaque paramètre aux getters de ton Entité
    return $stmt->execute([
        'titre'              => $event->getTitle(),
        'description'        => $event->getDescription(),
        'date_evenement'     => $event->getDateEvent(),
        'heure'              => $event->getHour(),
        'lieu'               => $event->getPlace(),
        'type'               => $event->getType(),
        'image_url'          => $event->getImageUrl(),
        'mis_en_avant'       => $event->isTopEvent() ? 1 : 0,
        'statut'             => $event->isStatut() ? 1 : 0,
        'lien_programme_pdf' => $event->getProgUrl()
    ]);
    }
}