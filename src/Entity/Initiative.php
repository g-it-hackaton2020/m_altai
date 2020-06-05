<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InitiativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\EntityListeners;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=App\Repository\PeopleRepository\InitiativeRepository::class)
 * @ORM\EntityListeners({"App\EntityListeners\InitiativeListener"})
 * @HasLifecycleCallbacks
 */
class Initiative
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=PetitionType::class, inversedBy="initiatives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $initiative_type;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="initiatives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="signed_initiatives")
     */
    private $signers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $num;

    public function __construct()
    {
        $this->signers = new ArrayCollection();
        $this->id = Uuid::uuid4();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInitiativeType(): ?PetitionType
    {
        return $this->initiative_type;
    }

    public function setInitiativeType(?PetitionType $initiative_type): self
    {
        $this->initiative_type = $initiative_type;

        return $this;
    }

    public function getAutor(): ?People
    {
        return $this->autor;
    }

    public function setAutor(?People $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getSigners(): Collection
    {
        return $this->signers;
    }

    public function addSigner(People $signer): self
    {
        if (!$this->signers->contains($signer)) {
            $this->signers[] = $signer;
        }

        return $this;
    }

    public function removeSigner(People $signer): self
    {
        if ($this->signers->contains($signer)) {
            $this->signers->removeElement($signer);
        }

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(?int $num): self
    {
        $this->num = $num;

        return $this;
    }
}
