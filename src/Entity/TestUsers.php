<?php

namespace App\Entity;

use App\Repository\TestUsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestUsersRepository::class)]
class TestUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $username = null;

    #[ORM\Column(length: 75)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $is_member = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $is_active = null;

    #[ORM\Column(nullable: true)]
    private ?int $user_type = null;

    #[ORM\Column(nullable: true,type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $last_login_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIsMember(): ?int
    {
        return $this->is_member;
    }

    public function setIsMember(int $is_member): self
    {
        $this->is_member = $is_member;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->is_active;
    }

    public function setIsActive(?int $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getUserType(): ?int
    {
        return $this->user_type;
    }

    public function setUserType(int $user_type): self
    {
        $this->user_type = $user_type;

        return $this;
    }

    public function getLastLoginAt(): ?\DateTime
    {
        return $this->last_login_at;
    }

    public function setLastLoginAt(?\DateTime $last_login_at): self
    {
        $this->last_login_at = $last_login_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdateAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
