<?php

namespace App\Entity;

use App\Repository\ScriptsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScriptsRepository::class)]
class Scripts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $script_id = null;

    #[ORM\Column(length: 255)]
    private ?string $script_title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $script_name_english = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $script_author = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $script_description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $script_image_file_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $script_memo = null;

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

    public function getScriptId(): ?int
    {
        return $this->script_id;
    }

    public function getScriptTitle(): ?string
    {
        return $this->script_title;
    }

    public function setScriptTitle(string $script_title): static
    {
        $this->script_title = $script_title;

        return $this;
    }

    public function getScriptNameEnglish(): ?string
    {
        return $this->script_name_english;
    }

    public function setScriptNameEnglish(?string $script_name_english): static
    {
        $this->script_name_english = $script_name_english;

        return $this;
    }

    public function getScriptAuthor(): ?string
    {
        return $this->script_author;
    }

    public function setScriptAuthor(?string $script_author): static
    {
        $this->script_author = $script_author;

        return $this;
    }

    public function getScriptDescription(): ?string
    {
        return $this->script_description;
    }

    public function setScriptDescription(?string $script_description): static
    {
        $this->script_description = $script_description;

        return $this;
    }

    public function getScriptImageFilePath(): ?string
    {
        return $this->script_image_file_path;
    }

    public function setScriptImageFilePath(?string $script_image_file_path): static
    {
        $this->script_image_file_path = $script_image_file_path;

        return $this;
    }

    public function getScriptMemo(): ?string
    {
        return $this->script_memo;
    }

    public function setScriptMemo(?string $script_memo): static
    {
        $this->script_memo = $script_memo;

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
