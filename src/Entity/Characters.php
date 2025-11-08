<?php

namespace App\Entity;

use App\Repository\CharactersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharactersRepository::class)]
class Characters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $character_id = null;

    #[ORM\Column]
    private ?int $script_id = null;

    #[ORM\Column(length: 255)]
    private ?string $character_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $character_name_english = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $character_description = null;

    #[ORM\Column(length: 255)]
    private ?string $character_theme_color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $character_image_file_path = null;

    #[ORM\Column(nullable: true)]
    private ?int $character_gender_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $character_quote = null;

    #[ORM\Column]
    private ?bool $main_character_flag = null;

    #[ORM\Column]
    private ?int $character_selected_number = null;

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

    public function getCharacterId(): ?int
    {
        return $this->character_id;
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

    public function getCharacterName(): ?string
    {
        return $this->character_name;
    }

    public function setCharacterName(string $character_name): static
    {
        $this->character_name = $character_name;

        return $this;
    }

    public function getCharacterNameEnglish(): ?string
    {
        return $this->character_name_english;
    }

    public function setCharacterNameEnglish(?string $character_name_english): static
    {
        $this->character_name_english = $character_name_english;

        return $this;
    }

    public function getCharacterDescription(): ?string
    {
        return $this->character_description;
    }

    public function setCharacterDescription(?string $character_description): static
    {
        $this->character_description = $character_description;

        return $this;
    }

    public function getCharacterThemeColor(): ?string
    {
        return $this->character_theme_color;
    }

    public function setCharacterThemeColor(?string $character_theme_color): static
    {
        $this->character_theme_color = $character_theme_color;

        return $this;
    }

    public function getCharacterImageFilePath(): ?string
    {
        return $this->character_image_file_path;
    }

    public function setCharacterImageFilePath(?string $character_image_file_path): static
    {
        $this->character_image_file_path = $character_image_file_path;

        return $this;
    }

    public function getCharacterGenderCode(): ?int
    {
        return $this->character_gender_code;
    }

    public function setCharacterGenderCode(?int $character_gender_code): static
    {
        $this->character_gender_code = $character_gender_code;

        return $this;
    }

    public function getCharacterQuote(): ?string
    {
        return $this->character_quote;
    }

    public function setCharacterQuote(?string $character_quote): static
    {
        $this->character_quote = $character_quote;

        return $this;
    }

    public function isMainCharacterFlag(): ?bool
    {
        return $this->main_character_flag;
    }

    public function setMainCharacterFlag(bool $main_character_flag): static
    {
        $this->main_character_flag = $main_character_flag;

        return $this;
    }

    public function getCharacterSelectedNumber(): ?int
    {
        return $this->character_selected_number;
    }

    public function setCharacterSelectedNumber(int $character_selected_number): static
    {
        $this->character_selected_number = $character_selected_number;

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
