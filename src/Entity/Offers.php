<?php

namespace App\Entity;

use App\Repository\OffersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffersRepository::class)]
class Offers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(length: 36)]
    private ?string $user_uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body = null;

    #[ORM\Column]
    private ?int $budget = null;

    #[ORM\Column(length: 255)]
    private ?string $voice_type = null;

    #[ORM\Column]
    private ?bool $accomplished = null;

    #[ORM\Column(length: 255)]
    private ?string $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $end_at = null;

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

    public function getUserUuid(): ?string
    {
        return $this->user_uuid;
    }

    public function setUserUuid(string $userUuid): self
    {
        $this->user_uuid = $userUuid;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getVoiceTypes(): ?string
    {
        return $this->voice_type;
    }

    public function setVoiceTypes(string $voiceTypes): self
    {
        $this->voice_type = $voiceTypes;

        return $this;
    }

    public function isAccomplished(): ?bool
    {
        return $this->accomplished;
    }

    public function setAccomplished(bool $accomplished): self
    {
        $this->accomplished = $accomplished;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getEndAt(): ?string
    {
        return $this->end_at;
    }

    public function setEndAt(string $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }
}
