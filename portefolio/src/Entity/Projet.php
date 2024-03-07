<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[ApiResource]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $projetTitre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $projetDesc = null;

    #[ORM\Column(length: 255)]
    private ?string $projetUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projetResource = null;

    #[ORM\Column(length: 255)]
    private ?string $projetCopieEcr = null;

    #[ORM\ManyToMany(targetEntity: Techno::class, mappedBy: 'projet')]
    private Collection $technos;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'projet')]
    private Collection $users;

    public function __construct()
    {
        $this->technos = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjetTitre(): ?string
    {
        return $this->projetTitre;
    }

    public function setProjetTitre(string $projetTitre): static
    {
        $this->projetTitre = $projetTitre;

        return $this;
    }

    public function getProjetDesc(): ?string
    {
        return $this->projetDesc;
    }

    public function setProjetDesc(string $projetDesc): static
    {
        $this->projetDesc = $projetDesc;

        return $this;
    }

    public function getProjetUrl(): ?string
    {
        return $this->projetUrl;
    }

    public function setProjetUrl(string $projetUrl): static
    {
        $this->projetUrl = $projetUrl;

        return $this;
    }

    public function getProjetResource(): ?string
    {
        return $this->projetResource;
    }

    public function setProjetResource(?string $projetResource): static
    {
        $this->projetResource = $projetResource;

        return $this;
    }

    public function getProjetCopieEcr(): ?string
    {
        return $this->projetCopieEcr;
    }

    public function setProjetCopieEcr(string $projetCopieEcr): static
    {
        $this->projetCopieEcr = $projetCopieEcr;

        return $this;
    }

    /**
     * @return Collection<int, Techno>
     */
    public function getTechnos(): Collection
    {
        return $this->technos;
    }

    public function addTechno(Techno $techno): static
    {
        if (!$this->technos->contains($techno)) {
            $this->technos->add($techno);
            $techno->addProjet($this);
        }

        return $this;
    }

    public function removeTechno(Techno $techno): static
    {
        if ($this->technos->removeElement($techno)) {
            $techno->removeProjet($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setProjet($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProjet() === $this) {
                $user->setProjet(null);
            }
        }

        return $this;
    }
}
