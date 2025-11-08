<?php

namespace App\Entity;

use App\Repository\ScenesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScenesRepository::class)]
class Scenes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $scene_id = null;

    #[ORM\Column]
    private ?int $script_id = null;

    #[ORM\Column(length: 255)]
    private ?string $scene_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $scene_description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $scene_image_file_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $scene_memo = null;

    #[ORM\Column]
    private ?bool $play_flag = null;

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

    public function getSceneId(): ?int
    {
        return $this->scene_id;
    }

    public function getScriptId(): ?int
    {
        return $this->script_id;
    }

    public function setScriptId(int $script_id): static
    {
        $this->script_id = $script_id;

        return $this;
    }

    public function getSceneName(): ?string
    {
        return $this->scene_name;
    }

    public function setSceneName(string $scene_name): static
    {
        $this->scene_name = $scene_name;

        return $this;
    }

    public function getSceneDescription(): ?string
    {
        return $this->scene_description;
    }

    public function setSceneDescription(?string $scene_description): static
    {
        $this->scene_description = $scene_description;

        return $this;
    }

    public function getSceneImageFilePath(): ?string
    {
        return $this->scene_image_file_path;
    }

    public function setSceneImageFilePath(?string $scene_image_file_path): static
    {
        $this->scene_image_file_path = $scene_image_file_path;

        return $this;
    }

    public function getSceneMemo(): ?string
    {
        return $this->scene_memo;
    }

    public function setSceneMemo(?string $scene_memo): static
    {
        $this->scene_memo = $scene_memo;

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
