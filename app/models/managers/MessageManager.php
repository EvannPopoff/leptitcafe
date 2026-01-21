<?php
namespace app\models\managers;
use app\models\entities\Message;
use PDO;

class MessageManager {
    private PDO $db;

    public function __construct(PDO $db) { $this->db = $db; }

    public function create(Message $msg): bool {
        $sql = "INSERT INTO MESSAGES (nom, email, telephone, categorie, contenu, statut, date_envoi) 
                VALUES (:nom, :email, :tel, :cat, :cont, :statut, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nom'    => $msg->getNom(),
            'email'  => $msg->getEmail(),
            'tel'    => $msg->getTelephone(),
            'cat'    => $msg->getCategorie(),
            'cont'   => $msg->getContenu(),
            'statut' => $msg->getStatut()
        ]);
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM MESSAGES ORDER BY date_envoi DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}