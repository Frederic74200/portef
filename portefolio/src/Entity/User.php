<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $userNom = null;

    #[ORM\Column(length: 50)]
    private ?string $userPrenom = null;

    #[ORM\Column(length: 255)]
    private ?string $userMail = null;

    #[ORM\Column(length: 255)]
    private ?string $userPW = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userCV = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userAvatar = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?APropos $userApropos = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Projet $projet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserNom(): ?string
    {
        return $this->userNom;
    }

    public function setUserNom(string $userNom): static
    {
        $this->userNom = $userNom;

        return $this;
    }

    public function getUserPrenom(): ?string
    {
        return $this->userPrenom;
    }

    public function setUserPrenom(string $userPrenom): static
    {
        $this->userPrenom = $userPrenom;

        return $this;
    }

    public function getUserMail(): ?string
    {
        return $this->userMail;
    }

    public function setUserMail(string $userMail): static
    {
        $this->userMail = $userMail;

        return $this;
    }

    public function getUserPW(): ?string
    {
        return $this->userPW;
    }

    public function setUserPW(string $userPW): static
    {
        $this->userPW = $userPW;

        return $this;
    }

    public function getUserCV(): ?string
    {
        return $this->userCV;
    }

    public function setUserCV(?string $userCV): static
    {
        $this->userCV = $userCV;

        return $this;
    }

    public function getUserAvatar(): ?string
    {
        return $this->userAvatar;
    }

    public function setUserAvatar(?string $userAvatar): static
    {
        $this->userAvatar = $userAvatar;

        return $this;
    }

    public function getUserApropos(): ?APropos
    {
        return $this->userApropos;
    }

    public function setUserApropos(?APropos $userApropos): static
    {
        $this->userApropos = $userApropos;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
    }
}
