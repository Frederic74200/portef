<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AProposRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AProposRepository::class)]
#[ApiResource]
class APropos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $aProposTitre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $aPrpoposPar = null;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'userApropos')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAProposTitre(): ?string
    {
        return $this->aProposTitre;
    }

    public function setAProposTitre(string $aProposTitre): static
    {
        $this->aProposTitre = $aProposTitre;

        return $this;
    }

    public function getAPrpoposPar(): ?string
    {
        return $this->aPrpoposPar;
    }

    public function setAPrpoposPar(string $aPrpoposPar): static
    {
        $this->aPrpoposPar = $aPrpoposPar;

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
            $user->setUserApropos($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUserApropos() === $this) {
                $user->setUserApropos(null);
            }
        }

        return $this;
    }
}
