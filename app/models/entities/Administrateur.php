<?php
namespace app\models\entities;

class Administrateur {
    private ?int $id_admin;
    private string $email;
    private string $mot_de_passe;
    private ?string $date_creation;

    public function __construct(array $donnees = []) {
        if (!empty($donnees)) {
            $this->id_admin = $donnees['id_admin'] ?? null;
            $this->email = $donnees['email'] ?? '';
            $this->mot_de_passe = $donnees['mot_de_passe'] ?? '';
            $this->date_creation = $donnees['date_creation'] ?? null;
        }
    }
        public function getIdAdmin(): ?int {
        return $this->id_admin; }
        public function getEmail(): string {
        return $this->email; }
        public function getMotDePasse(): string {
        return $this->mot_de_passe;

        }
        public function verifierMotDePasse(string $motDePasse): bool {
        return password_verify($motDePasse, $this->mot_de_passe);
    }

}