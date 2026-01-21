<?php
namespace app\models\managers;
use PDO;

class SlotManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findBlockedSlots(): array {
        $sql = "SELECT * FROM creneau_horaire WHERE disponible = 0";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function blockSlot(array $data, int $id_admin): bool {
        $sql = "INSERT INTO creneau_horaire (date_creneau, heure_debut, heure_fin, disponible, motif_blocage, id_admin) 
                VALUES (:date_c, :h_debut, :h_fin, 0, :motif, :id_admin)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'date_c'   => $data['date_creneau'],
            'h_debut'  => $data['heure_debut'],
            'h_fin'    => $data['heure_fin'],
            'motif'    => $data['motif_blocage'] ?? 'Indisponible',
            'id_admin' => $id_admin
        ]);
    }
}