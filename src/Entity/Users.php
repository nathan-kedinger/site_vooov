<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $number_of_followers = null;

    #[ORM\Column]
    private ?int $number_of_moons = null;

    #[ORM\Column]
    private ?int $number_of_friends = null;

    #[ORM\Column(length: 255)]
    private ?string $url_profile_picture = null;

    #[ORM\OneToMany(mappedBy: 'artist_uuid', targetEntity: AudioRecords::class)]
    private Collection $audioRecords;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Offers::class)]
    private Collection $offers;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Conversations::class)]
    private Collection $conversations;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Messages::class)]
    private Collection $messages;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $sign_in = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_connection = null;

    public function __construct()
    {
        $this->audioRecords = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
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

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getNumberOfFollowers(): ?int
    {
        return $this->number_of_followers;
    }

    public function setNumberOfFollowers(int $number_of_followers): self
    {
        $this->number_of_followers = $number_of_followers;

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

    public function getNumberOfFriends(): ?int
    {
        return $this->number_of_friends;
    }

    public function setNumberOfFriends(int $number_of_friends): self
    {
        $this->number_of_friends = $number_of_friends;

        return $this;
    }

    public function getUrlProfilePicture(): ?string
    {
        return $this->url_profile_picture;
    }

    public function setUrlProfilePicture(string $url_profile_picture): self
    {
        $this->url_profile_picture = $url_profile_picture;

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
            $audioRecord->setArtistId($this);
        }

        return $this;
    }

    public function removeAudioRecord(AudioRecords $audioRecord): self
    {
        if ($this->audioRecords->removeElement($audioRecord)) {
            // set the owning side to null (unless already changed)
            if ($audioRecord->getArtistId() === $this) {
                $audioRecord->setArtistId(null);
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
            $offer->setUserId($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getUserId() === $this) {
                $offer->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Conversations>
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversations $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations->add($conversation);
            $conversation->setSender($this);
        }

        return $this;
    }

    public function removeConversation(Conversations $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            // set the owning side to null (unless already changed)
            if ($conversation->getSender() === $this) {
                $conversation->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setSender($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getSender() === $this) {
                $message->setSender(null);
            }
        }

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getSignIn(): ?\DateTimeInterface
    {
        return $this->sign_in;
    }

    public function setSignIn(\DateTimeInterface $sign_in): self
    {
        $this->sign_in = $sign_in;

        return $this;
    }

    public function getLastConnection(): ?\DateTimeInterface
    {
        return $this->last_connection;
    }

    public function setLastConnection(\DateTimeInterface $last_connection): self
    {
        $this->last_connection = $last_connection;

        return $this;
    }
}
