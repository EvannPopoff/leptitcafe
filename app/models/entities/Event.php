<?php
namespace app\models\entities;

class Event {
    private ?int $id_event;
    private string $title;
    private ?string $description;
    private string $date_event;
    private string $hour;
    private string $place;
    private ?string $type;
    private ?string $image_url;
    private bool $top_event;
    private bool $statut;
    private ?string $prog_url;


    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->id_event = $data['id_evenement'] ?? null;
            $this->title = $data['titre'] ?? '';
            $this->description = $data['description'] ?? null;
            $this->date_event = $data['date_evenement'] ?? '';
            $this->hour = $data['heure'] ?? '';
            $this->place = $data['lieu'] ?? '';
            $this->type = $data['type'] ?? null;
            $this->image_url = $data['image_url'] ?? null;
            $this->top_event = (bool)($data['mis_en_avant'] ?? false);
            $this->statut = (bool)($data['statut'] ?? true);
            $this->prog_url = $data['lien_programme_pdf'] ?? null;
        }
    }

    public function getIdEvent(): ?int {
        return $this->id_event;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getDateEvent(): string {
        return $this->date_event;
    }

    public function getHour(): string {
        return $this->hour;
    }

    public function getPlace(): string {
        return $this->place;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function getImageUrl(): ?string {
        return $this->image_url;
    }

    public function isTopEvent(): bool {
        return $this->top_event;
    }

    public function isStatut(): bool {
        return $this->statut;
    }

    public function getProgUrl(): ?string {
        return $this->prog_url;
    }

}