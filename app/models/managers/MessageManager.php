<?php
namespace app\models\managers;
use app\models\entities\Message;
use PDO;

class MessageManager {
    private PDO $db;

    public function __construct(PDO $db) { $this->db = $db; }

    public function findAll(): array {
        // 1. Utilise bien le nom MESSAGE_CONTACT
        $stmt = $this->db->query("SELECT * FROM MESSAGE_CONTACT ORDER BY date_envoi DESC");
        
        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // 2. CRITIQUE : Transformer le tableau en OBJET Message
            $messages[] = new Message($row); 
        }
        return $messages;
    }
    /**
     * Enregistre un nouveau message (Côté client)
     */
    public function create(Message $msg): bool {
        $sql = "INSERT INTO MESSAGE_CONTACT (nom, email, telephone, categorie, contenu, statut, date_envoi) 
                VALUES (:nom, :email, :tel, :cat, :cont, :statut, NOW())";
    
        $stmt = $this->db->prepare($sql);
    
        return $stmt->execute([
            'nom' => $msg->getNom(),
            'email' => $msg->getEmail(),
            'tel' => $msg->getTelephone(),
            'cat' => $msg->getCategorie(),
            'cont' => $msg->getContenu(),
            'statut' => $msg->getStatut(),
        ]);
    }

    /**
     * Récupère tous les messages sous forme d'objets Message (Côté Admin)
     */
    public function findAll(): array {
        // Utilisation du bon nom de table : MESSAGE_CONTACT
        $stmt = $this->db->query("SELECT * FROM MESSAGE_CONTACT ORDER BY date_envoi DESC");
        
        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // On transforme chaque ligne SQL en objet "Message"
            $messages[] = new Message($row);
        }
        return $messages;
    }

    /**
     * Marque un message comme traité lorsqu'on y répond
     */
    public function markAsTreated(int $id_message, int $id_admin): bool {
        $sql = "UPDATE MESSAGE_CONTACT 
                SET statut = 1, date_traitement = NOW(), id_admin = :admin 
                WHERE id_message = :id";
                
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'admin' => $id_admin,
            'id'    => $id_message
        ]);
    }
}