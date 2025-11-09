<?php

namespace App\Entity;

use App\Repository\AdminsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminsRepository::class)]
class Admins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $admin_id = null;

    #[ORM\Column(length: 255)]
    private ?string $admin_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nickname = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $login_datetime = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $logout_datetime = null;

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

    public function getAdminsId(): ?int
    {
        return $this->admin_id;
    }

    public function setAdminsId(int $admin_id): static
    {
        $this->admin_id = $admin_id;

        return $this;
    }

    public function getAdminsCode(): ?string
    {
        return $this->admin_code;
    }

    public function setAdminsCode(string $admin_code): static
    {
        $this->admin_code = $admin_code;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLoginDatetime(): ?\DateTime
    {
        return $this->login_datetime;
    }

    public function setLoginDatetime(?\DateTime $login_datetime): static
    {
        $this->login_datetime = $login_datetime;

        return $this;
    }

    public function getLogoutDatetime(): ?\DateTime
    {
        return $this->logout_datetime;
    }

    public function setLogoutDatetime(?\DateTime $logout_datetime): static
    {
        $this->logout_datetime = $logout_datetime;

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

    public function getCreatedAdmins(): ?int
    {
        return $this->created_admin;
    }

    public function setCreatedAdmins(int $created_admin): static
    {
        $this->created_admin = $created_admin;

        return $this;
    }

    public function getUpdatedAdmins(): ?int
    {
        return $this->updated_admin;
    }

    public function setUpdatedAdmins(?int $updated_admin): static
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
