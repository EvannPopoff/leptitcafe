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
        $sql = "SELECT * FROM evenement ORDER BY date_evenement ASC, heure ASC";
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
        $sql = "SELECT * FROM evenement WHERE id_evenement = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Event($data) : null;
    }
}