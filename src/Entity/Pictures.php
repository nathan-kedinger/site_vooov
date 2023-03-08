<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
class Pictures
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
    private ?string $url = null;

    #[ORM\Column(length: 5)]
    private ?string $format = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\Column(length: 255)]
    private ?string $upload_at = null;

    #[ORM\Column]
    private ?bool $validated = null;

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

    public function setUserUuid(string $user_uuid): self
    {
        $this->user_uuid = $user_uuid;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getUploadAt(): ?string
    {
        return $this->upload_at;
    }

    public function setUploadAt(string $upload_at): self
    {
        $this->upload_at = $upload_at;

        return $this;
    }

    public function isValidated(): ?bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): self
    {
        $this->validated = $validated;

        return $this;
    }
}
