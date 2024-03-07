<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TechnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechnoRepository::class)]
#[ApiResource]
class Techno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50,  unique: true)]
    private ?string $technoNom = null;

    #[ORM\ManyToMany(targetEntity: Projet::class, inversedBy: 'technos')]
    private Collection $projet;

    public function __construct()
    {
        $this->projet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechnoNom(): ?string
    {
        return $this->technoNom;
    }

    public function setTechnoNom(string $technoNom): static
    {
        $this->technoNom = $technoNom;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjet(): Collection
    {
        return $this->projet;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projet->contains($projet)) {
            $this->projet->add($projet);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        $this->projet->removeElement($projet);

        return $this;
    }
}
