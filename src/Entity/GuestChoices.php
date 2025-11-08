<?php

namespace App\Entity;

use App\Repository\GuestChoicesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestChoicesRepository::class)]
class GuestChoices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $guest_choice_id = null;

    #[ORM\Column]
    private ?int $gest_id = null;

    #[ORM\Column]
    private ?int $question_id = null;

    #[ORM\Column]
    private ?int $choice_id = null;

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

    public function getGuestChoiceId(): ?int
    {
        return $this->guest_choice_id;
    }

    public function getGestId(): ?int
    {
        return $this->gest_id;
    }

    public function setGestId(int $gest_id): static
    {
        $this->gest_id = $gest_id;

        return $this;
    }

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): static
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getChoiceId(): ?int
    {
        return $this->choice_id;
    }

    public function setChoiceId(int $choice_id): static
    {
        $this->choice_id = $choice_id;

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
