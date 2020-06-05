<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=App\Repository\PetitionRepository::class)
 */
class Petition
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
     * @ORM\ManyToOne(targetEntity=PetitionType::class, inversedBy="petitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $petition_type;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="signed_petitions")
     */
    private $signers;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="my_petitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(initialValue=1,allocationSize=1,sequenceName="petition_num_sequens")
     */
    private $num;

    public function __construct()
    {
        $this->signers = new ArrayCollection();
        $this->id = Uuid::uuid4();
    }

    public function __toString()
    {
        return $this->name."   ".$this->num;
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

    public function getPetitionType(): ?PetitionType
    {
        return $this->petition_type;
    }

    public function setPetitionType(?PetitionType $petition_type): self
    {
        $this->petition_type = $petition_type;

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

    public function getAutor(): ?People
    {
        return $this->autor;
    }

    public function setAutor(?People $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }
}
