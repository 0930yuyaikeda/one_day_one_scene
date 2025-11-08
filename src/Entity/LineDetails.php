<?php

namespace App\Entity;

use App\Repository\LineDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineDetailsRepository::class)]
class LineDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $line_detail_id = null;

    #[ORM\Column]
    private ?int $line_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $before_line_detail_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $after_line_detail_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $line = null;

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

    public function getLineDetailId(): ?int
    {
        return $this->line_detail_id;
    }

    public function getLineId(): ?int
    {
        return $this->line_id;
    }

    public function setLineId(int $line_id): static
    {
        $this->line_id = $line_id;

        return $this;
    }

    public function getBeforeLineDetailId(): ?int
    {
        return $this->before_line_detail_id;
    }

    public function setBeforeLineDetailId(?int $before_line_detail_id): static
    {
        $this->before_line_detail_id = $before_line_detail_id;

        return $this;
    }

    public function getAfterLineDetailId(): ?int
    {
        return $this->after_line_detail_id;
    }

    public function setAfterLineDetailId(?int $after_line_detail_id): static
    {
        $this->after_line_detail_id = $after_line_detail_id;

        return $this;
    }

    public function getLine(): ?string
    {
        return $this->line;
    }

    public function setLine(?string $line): static
    {
        $this->line = $line;

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
