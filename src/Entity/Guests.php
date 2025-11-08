<?php

namespace App\Entity;

use App\Repository\GuestsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestsRepository::class)]
class Guests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $guest_id = null;

    #[ORM\Column]
    private ?int $gest_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gest_name = null;

    #[ORM\Column]
    private ?int $gest_gender_code = null;

    #[ORM\Column(nullable: true)]
    private ?int $deck_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $character_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $script_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $scene_id = null;

    #[ORM\Column]
    private ?bool $performance_flag = null;

    #[ORM\Column]
    private ?\DateTime $created_datetime = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updated_datetime = null;

    #[ORM\Column]
    private ?int $created_admin = null;

    #[ORM\Column(nullable: true)]
    private ?int $updated_admin = null;

    #[ORM\Column]
    private ?bool $valid_flag = null;

    public function getGuestId(): ?int
    {
        return $this->guest_id;
    }

    public function getGestType(): ?int
    {
        return $this->gest_type;
    }

    public function setGestType(int $gest_type): static
    {
        $this->gest_type = $gest_type;

        return $this;
    }

    public function getGestName(): ?string
    {
        return $this->gest_name;
    }

    public function setGestName(?string $gest_name): static
    {
        $this->gest_name = $gest_name;

        return $this;
    }

    public function getGestGenderCode(): ?int
    {
        return $this->gest_gender_code;
    }

    public function setGestGenderCode(int $gest_gender_code): static
    {
        $this->gest_gender_code = $gest_gender_code;

        return $this;
    }

    public function getDeckId(): ?int
    {
        return $this->deck_id;
    }

    public function setDeckId(?int $deck_id): static
    {
        $this->deck_id = $deck_id;

        return $this;
    }

    public function getCharacterId(): ?int
    {
        return $this->character_id;
    }

    public function setCharacterId(?int $character_id): static
    {
        $this->character_id = $character_id;

        return $this;
    }

    public function getScriptId(): ?int
    {
        return $this->script_id;
    }

    public function setScriptId(?int $script_id): static
    {
        $this->script_id = $script_id;

        return $this;
    }

    public function getSceneId(): ?int
    {
        return $this->scene_id;
    }

    public function setSceneId(?int $scene_id): static
    {
        $this->scene_id = $scene_id;

        return $this;
    }

    public function isPerformanceFlag(): ?bool
    {
        return $this->performance_flag;
    }

    public function setPerformanceFlag(bool $performance_flag): static
    {
        $this->performance_flag = $performance_flag;

        return $this;
    }

    public function getCreatedDatetime(): ?\DateTime
    {
        return $this->created_datetime;
    }

    public function setCreatedDatetime(\DateTime $created_datetime): static
    {
        $this->created_datetime = $created_datetime;

        return $this;
    }

    public function getUpdatedDatetime(): ?\DateTime
    {
        return $this->updated_datetime;
    }

    public function setUpdatedDatetime(?\DateTime $updated_datetime): static
    {
        $this->updated_datetime = $updated_datetime;

        return $this;
    }

    public function getCreatedAdmin(): ?int
    {
        return $this->created_admin;
    }

    public function setCreatedAdmin(int $created_admin): static
    {
        $this->created_admin = $created_admin;

        return $this;
    }

    public function getUpdatedAdmin(): ?int
    {
        return $this->updated_admin;
    }

    public function setUpdatedAdmin(?int $updated_admin): static
    {
        $this->updated_admin = $updated_admin;

        return $this;
    }

    public function isValidFlag(): ?bool
    {
        return $this->valid_flag;
    }

    public function setValidFlag(bool $valid_flag): static
    {
        $this->valid_flag = $valid_flag;

        return $this;
    }
}
