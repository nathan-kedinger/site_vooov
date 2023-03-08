<?php

namespace App\Entity;

use App\Repository\FriendsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendsRepository::class)]
class Friends
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(length: 36)]
    private ?string $user1 = null;

    #[ORM\Column(length: 36)]
    private ?string $user2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUser1(): ?string
    {
        return $this->user1;
    }

    public function setUser1(string $user1): self
    {
        $this->user1 = $user1;

        return $this;
    }

    public function getUser2(): ?string
    {
        return $this->user2;
    }

    public function setUser2(string $user2): self
    {
        $this->user2 = $user2;

        return $this;
    }
}
