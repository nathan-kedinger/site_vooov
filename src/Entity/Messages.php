<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(length: 36)]
    private ?string $conversation_uuid = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body = null;

    #[ORM\Column]
    private ?bool $seen = null;

    #[ORM\Column(length: 255)]
    private ?string $send_at = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $sender = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $receiver = null;

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

    public function getConversationUuid(): ?string
    {
        return $this->conversation_uuid;
    }

    public function setConversationUuid(string $conversation_uuid): self
    {
        $this->conversation_uuid = $conversation_uuid;

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

    public function isSeen(): ?bool
    {
        return $this->seen;
    }

    public function setSeen(bool $seen): self
    {
        $this->seen = $seen;

        return $this;
    }

    public function getSendAt(): ?string
    {
        return $this->send_at;
    }

    public function setSendAt(string $send_at): self
    {
        $this->send_at = $send_at;

        return $this;
    }

    public function getSender(): ?Users
    {
        return $this->sender;
    }

    public function setSender(?Users $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?Users
    {
        return $this->receiver;
    }

    public function setReceiver(?Users $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }
}
