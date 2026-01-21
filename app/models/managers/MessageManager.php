<?php
namespace app\models\managers;
use app\models\entities\Message;
use PDO;

class MessageManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // Sauvegarder un message (Côté Visiteur)
    public function create(Message $msg): bool {
        $sql = "INSERT INTO MESSAGES (nom, email, telephone, categorie, contenu, statut, date_envoi) 
                VALUES (:nom, :email, :tel, :cat, :cont, 0, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nom'   => $msg->getNom(),
            'email' => $msg->getEmail(),
            'tel'   => $msg->getTelephone(),
            'cat'   => $msg->getCategorie(),
            'cont'  => $msg->getContenu()
        ]);
    }

    // Lister tous les messages (Côté Admin)
    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM MESSAGES ORDER BY date_envoi DESC");
        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message($row);
        }
        return $messages;
    }

    // Marquer comme traité quand l'admin répond
    public function markAsRead(int $id, int $id_admin): bool {
        $sql = "UPDATE MESSAGES SET statut = 1, date_traitement = NOW(), id_admin = :admin 
                WHERE id_message = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['admin' => $id_admin, 'id' => $id]);
    }
}