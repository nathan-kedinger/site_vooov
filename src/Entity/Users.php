<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 36)]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $birthday = null;

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

    #[ORM\Column(length: 255)]
    private ?string $sign_in = null;

    #[ORM\Column(length: 255)]
    private ?string $last_connection = null;

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

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): self
    {
        $this->birthday = $birthday;

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

    public function getSignIn(): ?string
    {
        return $this->sign_in;
    }

    public function setSignIn(string $sign_in): self
    {
        $this->sign_in = $sign_in;

        return $this;
    }

    public function getLastConnection(): ?string
    {
        return $this->last_connection;
    }

    public function setLastConnection(string $last_connection): self
    {
        $this->last_connection = $last_connection;

        return $this;
    }
}
