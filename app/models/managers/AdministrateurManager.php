<?php
namespace app\models\managers;
use app\models\entities\Administrateur;
use PDO;

class AdministrateurManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getByEmail(string $email): ?Administrateur {
        $sql = "SELECT * FROM ADMINISTRATEUR WHERE email = :email";
        $stmt = $this->db->prepare($sql);

        $stmt->execute(['email' => $email]);
        $donnees = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($donnees) {
            return new Administrateur($donnees);
        }
        return null;
    }
}
