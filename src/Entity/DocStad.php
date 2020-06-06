<?php

namespace App\Entity;

use App\Repository\DocStadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocStadRepository::class)
 */
class DocStad
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Petition::class, mappedBy="stad")
     */
    private $petitions;

    /**
     * @ORM\OneToMany(targetEntity=Initiative::class, mappedBy="stad")
     */
    private $initiatives;

    public function __construct(string $id_name)
    {
        $this->id = $id_name;
        $this->petitions = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?string
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
            $petition->setStad($this);
        }

        return $this;
    }

    public function removePetition(Petition $petition): self
    {
        if ($this->petitions->contains($petition)) {
            $this->petitions->removeElement($petition);
            // set the owning side to null (unless already changed)
            if ($petition->getStad() === $this) {
                $petition->setStad(null);
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
            $initiative->setStad($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->contains($initiative)) {
            $this->initiatives->removeElement($initiative);
            // set the owning side to null (unless already changed)
            if ($initiative->getStad() === $this) {
                $initiative->setStad(null);
            }
        }

        return $this;
    }
}
