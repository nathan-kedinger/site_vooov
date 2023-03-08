<?php

namespace App\Entity;

use App\Repository\AudioRecordsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AudioRecordsRepository::class)]
class AudioRecords
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(length: 36)]
    private ?string $artist_uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $length = null;

    #[ORM\Column]
    private ?int $number_of_plays = null;

    #[ORM\Column]
    private ?int $number_of_moons = null;

    #[ORM\Column(length: 255)]
    private ?string $voice_style = null;

    #[ORM\Column(length: 255)]
    private ?string $kind = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $updated_at = null;

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

    public function getArtistUuid(): ?string
    {
        return $this->artist_uuid;
    }

    public function setArtistUuid(string $artist_uuid): self
    {
        $this->artist_uuid = $artist_uuid;

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

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getNumberOfPlays(): ?int
    {
        return $this->number_of_plays;
    }

    public function setNumberOfPlays(int $number_of_plays): self
    {
        $this->number_of_plays = $number_of_plays;

        return $this;
    }

    public function getNumberOfMoons(): ?int
    {
        return $this->number_of_moons;
    }

    public function setNumberOfMoons(int $number_of_moons): self
    {
        $this->number_of_moons = $number_of_moons;

        return $this;
    }

    public function getVoiceStyle(): ?string
    {
        return $this->voice_style;
    }

    public function setVoiceStyle(string $voice_style): self
    {
        $this->voice_style = $voice_style;

        return $this;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
