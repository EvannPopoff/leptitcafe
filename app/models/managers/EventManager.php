<?php
namespace app\models\managers;
use app\models\entities\Event;
use PDO;

class EventManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /** Praticité pour le dev ensuite (DocBlock) : 
    *@return Event[] */

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

    public function create(Event $event, int $id_admin): bool {
        $sql = "INSERT INTO EVENEMENT (titre, description, date_evenement, heure, lieu, type, image_url, mis_en_avant, statut, lien_programme_pdf, id_admin) 
                VALUES (:titre, :description, :date_evenement, :heure, :lieu, :type, :image_url, :mis_en_avant, :statut, :lien_programme_pdf, :id_admin)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'titre' => $event->getTitle(),
            'description' => $event->getDescription(),
            'date_evenement' => $event->getDateEvent(),
            'heure' => $event->getHour(),
            'lieu' => $event->getPlace(),
            'type' => $event->getType(),
            'image_url' => $event->getImageUrl(),
            'mis_en_avant' => $event->isTopEvent() ? 1 : 0,
            'statut' => $event->isStatut() ? 1 : 0,
            'lien_programme_pdf' => $event->getProgUrl(),
            'created_by' => $id_admin
        ]);
    }
}