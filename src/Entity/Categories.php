<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'kind', targetEntity: AudioRecords::class)]
    private Collection $audioRecords;

    public function __construct()
    {
        $this->audioRecords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $audioRecord->setKind($this);
        }

        return $this;
    }

    public function removeAudioRecord(AudioRecords $audioRecord): self
    {
        if ($this->audioRecords->removeElement($audioRecord)) {
            // set the owning side to null (unless already changed)
            if ($audioRecord->getKind() === $this) {
                $audioRecord->setKind(null);
            }
        }

        return $this;
    }
}
