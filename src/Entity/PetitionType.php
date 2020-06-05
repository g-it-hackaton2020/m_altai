<?php

namespace App\Entity;

use App\Repository\PetitionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=App\Repository\PetitionTypeRepository::class)
 */
class PetitionType
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Petition::class, mappedBy="petition_type")
     */
    private $petitions;

    /**
     * @ORM\OneToMany(targetEntity=Initiative::class, mappedBy="initiative_type")
     */
    private $initiatives;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_type;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->petitions = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
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
     * @return Collection|Petition[]
     */
    public function getPetitions(): Collection
    {
        return $this->petitions;
    }

    public function addPetition(Petition $petition): self
    {
        if (!$this->petitions->contains($petition)) {
            $this->petitions[] = $petition;
            $petition->setPetitionType($this);
        }

        return $this;
    }

    public function removePetition(Petition $petition): self
    {
        if ($this->petitions->contains($petition)) {
            $this->petitions->removeElement($petition);
            // set the owning side to null (unless already changed)
            if ($petition->getPetitionType() === $this) {
                $petition->setPetitionType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Initiative[]
     */
    public function getInitiatives(): Collection
    {
        return $this->initiatives;
    }

    public function addInitiative(Initiative $initiative): self
    {
        if (!$this->initiatives->contains($initiative)) {
            $this->initiatives[] = $initiative;
            $initiative->setInitiativeType($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->contains($initiative)) {
            $this->initiatives->removeElement($initiative);
            // set the owning side to null (unless already changed)
            if ($initiative->getInitiativeType() === $this) {
                $initiative->setInitiativeType(null);
            }
        }

        return $this;
    }

    public function getCodeType(): ?int
    {
        return $this->code_type;
    }

    public function setCodeType(int $code_type): self
    {
        $this->code_type = $code_type;

        return $this;
    }
}
