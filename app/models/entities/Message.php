<?php
namespace app\models\entities;

class Message {
    private ?int $id_message;
    private string $nom;
    private string $email;
    private ?string $telephone;
    private string $categorie;
    private string $contenu;
    private int $statut; // 0: Nouveau, 1: Traité
    private string $date_envoi;
    private ?string $date_traitement;
    private ?int $id_admin;

    public function __construct(array $data = []) {
        $this->id_message = $data['id_message'] ?? null;
        $this->nom = $data['nom'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->telephone = $data['telephone'] ?? null;
        $this->categorie = $data['categorie'] ?? '';
        $this->contenu = $data['contenu'] ?? '';
        $this->statut = (int)($data['statut'] ?? 0);
        $this->date_envoi = $data['date_envoi'] ?? date('Y-m-d H:i:s');
        $this->date_traitement = $data['date_traitement'] ?? null;
        $this->id_admin = $data['id_admin'] ?? null;
    }

    // Getters
    public function getIdMessage(): ?int { return $this->id_message; }
    public function getNom(): string { return $this->nom; }
    public function getEmail(): string { return $this->email; }
    public function getTelephone(): ?string { return $this->telephone; }
    public function getCategorie(): string { return $this->categorie; }
    public function getContenu(): string { return $this->contenu; }
    public function getStatut(): int { return $this->statut; }
    public function getDateEnvoi(): string { return $this->date_envoi; }
}