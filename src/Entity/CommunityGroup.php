<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PeopleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\UuidInterface;

/**
 * 
 * Сообщества пользователей
 * 
 * @ApiResource
 * @ORM\Entity(repositoryClass=App\Repository\CommunityGroupRepository::class)
 */
class CommunityGroup
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $community_name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="lead_of")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lead;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="communityGroups")
     */
    private $peoples;


    /**
     * @ORM\OneToMany(targetEntity=Initiative::class, mappedBy="community_group")
     */
    private $initiatives;

    /**
     * @ORM\OneToMany(targetEntity=Petition::class, mappedBy="community_group")
     */
    private $petitions;

    public function __construct()
    {
        $this->id = \Ramsey\Uuid\Uuid::uuid4();
        $this->peoples = new ArrayCollection();
        $this->petitions = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->community_name;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCommunityName(): ?string
    {
        return $this->community_name;
    }

    public function setCommunityName(string $community_name): self
    {
        $this->community_name = $community_name;

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

    public function getLead(): ?People
    {
        return $this->lead;
    }

    public function setLead(?People $lead): self
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getPeoples(): Collection
    {
        return $this->peoples;
    }

    public function addPeople(People $people): self
    {
        if (!$this->peoples->contains($people)) {
            $this->peoples[] = $people;
        }

        return $this;
    }

    public function removePeople(People $people): self
    {
        if ($this->peoples->contains($people)) {
            $this->peoples->removeElement($people);
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
            $initiative->addCommunityGroup($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->contains($initiative)) {
            $this->initiatives->removeElement($initiative);
            $initiative->removeCommunityGroup($this);
        }

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
            $petition->addCommunityGroup($this);
        }

        return $this;
    }

    public function removePetition(Petition $petition): self
    {
        if ($this->petitions->contains($petition)) {
            $this->petitions->removeElement($petition);
            $petition->removeCommunityGroup($this);
        }

        return $this;
    }
}
