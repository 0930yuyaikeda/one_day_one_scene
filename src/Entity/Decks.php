<?php

namespace App\Entity;

use App\Repository\DecksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DecksRepository::class)]
class Decks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $deck_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deck_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deck_description = null;

    #[ORM\Column]
    private ?bool $play_flag = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deck_memo = null;

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

    public function getDeckId(): ?int
    {
        return $this->deck_id;
    }

    public function getDeckName(): ?string
    {
        return $this->deck_name;
    }

    public function setDeckName(?string $deck_name): static
    {
        $this->deck_name = $deck_name;

        return $this;
    }

    public function getDeckDescription(): ?string
    {
        return $this->deck_description;
    }

    public function setDeckDescription(?string $deck_description): static
    {
        $this->deck_description = $deck_description;

        return $this;
    }

    public function isPlayFlag(): ?bool
    {
        return $this->play_flag;
    }

    public function setPlayFlag(bool $play_flag): static
    {
        $this->play_flag = $play_flag;

        return $this;
    }

    public function getDeckMemo(): ?string
    {
        return $this->deck_memo;
    }

    public function setDeckMemo(?string $deck_memo): static
    {
        $this->deck_memo = $deck_memo;

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
