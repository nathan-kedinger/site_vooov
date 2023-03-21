<?php

namespace App\Entity;

use App\Repository\VoiceStyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoiceStyleRepository::class)]
class VoiceStyle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $voice_style = null;

    #[ORM\OneToMany(mappedBy: 'voice_style', targetEntity: AudioRecords::class)]
    private Collection $audioRecords;

    #[ORM\OneToMany(mappedBy: 'voice_style', targetEntity: Offers::class)]
    private Collection $offers;

    public function __construct()
    {
        $this->audioRecords = new ArrayCollection();
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, AudioRecords>
     */
    public function getAudioRecords(): Collection
    {
        return $this->audioRecords;
    }

    public function addAudioRecord(AudioRecords $audioRecord): self
    {
        if (!$this->audioRecords->contains($audioRecord)) {
            $this->audioRecords->add($audioRecord);
            $audioRecord->setVoiceStyle($this);
        }

        return $this;
    }

    public function removeAudioRecord(AudioRecords $audioRecord): self
    {
        if ($this->audioRecords->removeElement($audioRecord)) {
            // set the owning side to null (unless already changed)
            if ($audioRecord->getVoiceStyle() === $this) {
                $audioRecord->setVoiceStyle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offers>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offers $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setVoiceStyle($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getVoiceStyle() === $this) {
                $offer->setVoiceStyle(null);
            }
        }

        return $this;
    }
}
