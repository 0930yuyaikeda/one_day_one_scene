<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $question_id = null;

    #[ORM\Column]
    private ?int $deck_id = null;

    #[ORM\Column(length: 255)]
    private ?string $question_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question_description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question_memo = null;

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

    private array $choices = [];

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function getDeckId(): ?int
    {
        return $this->deck_id;
    }

    public function setDeckId(int $deck_id): static
    {
        $this->deck_id = $deck_id;

        return $this;
    }

    public function getQuestionName(): ?string
    {
        return $this->question_name;
    }

    public function setQuestionName(string $question_name): static
    {
        $this->question_name = $question_name;

        return $this;
    }

    public function getQuestionDescription(): ?string
    {
        return $this->question_description;
    }

    public function setQuestionDescription(?string $question_description): static
    {
        $this->question_description = $question_description;

        return $this;
    }

    public function getQuestionMemo(): ?string
    {
        return $this->question_memo;
    }

    public function setQuestionMemo(?string $question_memo): static
    {
        $this->question_memo = $question_memo;

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

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function setChoices(array $choices): self
    {
        $this->choices = $choices;
        return $this;
    }
}
