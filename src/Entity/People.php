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
 * @ApiResource
 * @ORM\Entity(repositoryClass=App\Repository\PeopleRepository::class)
 */
class People
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
    private $fam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $im;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ot;

    /**
     * @ORM\Column(type="date")
     */
    private $birth_date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=CommunityGroup::class, mappedBy="lead")
     */
    private $lead_of;

    /**
     * @ORM\ManyToMany(targetEntity=CommunityGroup::class, mappedBy="peoples")
     */
    private $communityGroups;

    /**
     * @ORM\ManyToMany(targetEntity=Petition::class, mappedBy="signers")
     */
    private $signed_petitions;

    /**
     * @ORM\OneToMany(targetEntity=Petition::class, mappedBy="autor")
     */
    private $my_petitions;

    /**
     * @ORM\OneToMany(targetEntity=Initiative::class, mappedBy="autor")
     */
    private $initiatives;

    /**
     * @ORM\ManyToMany(targetEntity=Initiative::class, mappedBy="signers")
     */
    private $signed_initiatives;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="people", cascade={"persist", "remove"})
     */
    private $p_user;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="author", orphanRemoval=true)
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity=Message::class, mappedBy="likers")
     */
    private $likes_messages;

    /**
     * @ORM\ManyToMany(targetEntity=Message::class, mappedBy="dislikers")
     */
    private $dislikes_messages;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="principals")
     */
    private $trusted_leader;

    /**
     * @ORM\OneToMany(targetEntity=People::class, mappedBy="trusted_leader")
     */
    private $principals;

    public function __construct()
    {
        $this->id = \Ramsey\Uuid\Uuid::uuid4();
        $this->lead_of = new ArrayCollection();
        $this->communityGroups = new ArrayCollection();
        $this->signed_petitions = new ArrayCollection();
        $this->my_petitions = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
        $this->signed_initiatives = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->likes_messages = new ArrayCollection();
        $this->dislikes_messages = new ArrayCollection();
        $this->principals = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->fam." ".$this->im." ".$this->ot;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getFam(): ?string
    {
        return $this->fam;
    }

    public function setFam(string $fam): self
    {
        $this->fam = $fam;

        return $this;
    }

    public function getIm(): ?string
    {
        return $this->im;
    }

    public function setIm(string $im): self
    {
        $this->im = $im;

        return $this;
    }

    public function getOt(): ?string
    {
        return $this->ot;
    }

    public function setOt(?string $ot): self
    {
        $this->ot = $ot;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getSex(): ?bool
    {
        return $this->sex;
    }

    public function setSex(bool $sex): self
    {
        $this->sex = $sex;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|CommunityGroup[]
     */
    public function getLeadOf(): Collection
    {
        return $this->lead_of;
    }

    public function addLeadOf(CommunityGroup $leadOf): self
    {
        if (!$this->lead_of->contains($leadOf)) {
            $this->lead_of[] = $leadOf;
            $leadOf->setLead($this);
        }

        return $this;
    }

    public function removeLeadOf(CommunityGroup $leadOf): self
    {
        if ($this->lead_of->contains($leadOf)) {
            $this->lead_of->removeElement($leadOf);
            // set the owning side to null (unless already changed)
            if ($leadOf->getLead() === $this) {
                $leadOf->setLead(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommunityGroup[]
     */
    public function getCommunityGroups(): Collection
    {
        return $this->communityGroups;
    }

    public function addCommunityGroup(CommunityGroup $communityGroup): self
    {
        if (!$this->communityGroups->contains($communityGroup)) {
            $this->communityGroups[] = $communityGroup;
            $communityGroup->addPeople($this);
        }

        return $this;
    }

    public function removeCommunityGroup(CommunityGroup $communityGroup): self
    {
        if ($this->communityGroups->contains($communityGroup)) {
            $this->communityGroups->removeElement($communityGroup);
            $communityGroup->removePeople($this);
        }

        return $this;
    }

    /**
     * @return Collection|Petition[]
     */
    public function getSignedPetitions(): Collection
    {
        return $this->signed_petitions;
    }

    public function addSignedPetition(Petition $signedPetition): self
    {
        if (!$this->signed_petitions->contains($signedPetition)) {
            $this->signed_petitions[] = $signedPetition;
            $signedPetition->addSigner($this);
        }

        return $this;
    }

    public function removeSignedPetition(Petition $signedPetition): self
    {
        if ($this->signed_petitions->contains($signedPetition)) {
            $this->signed_petitions->removeElement($signedPetition);
            $signedPetition->removeSigner($this);
        }

        return $this;
    }

    /**
     * @return Collection|Petition[]
     */
    public function getMyPetitions(): Collection
    {
        return $this->my_petitions;
    }

    public function addMyPetition(Petition $myPetition): self
    {
        if (!$this->my_petitions->contains($myPetition)) {
            $this->my_petitions[] = $myPetition;
            $myPetition->setAutor($this);
        }

        return $this;
    }

    public function removeMyPetition(Petition $myPetition): self
    {
        if ($this->my_petitions->contains($myPetition)) {
            $this->my_petitions->removeElement($myPetition);
            // set the owning side to null (unless already changed)
            if ($myPetition->getAutor() === $this) {
                $myPetition->setAutor(null);
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
            $initiative->setAutor($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->contains($initiative)) {
            $this->initiatives->removeElement($initiative);
            // set the owning side to null (unless already changed)
            if ($initiative->getAutor() === $this) {
                $initiative->setAutor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Initiative[]
     */
    public function getSignedInitiatives(): Collection
    {
        return $this->signed_initiatives;
    }

    public function addSignedInitiative(Initiative $signedInitiative): self
    {
        if (!$this->signed_initiatives->contains($signedInitiative)) {
            $this->signed_initiatives[] = $signedInitiative;
            $signedInitiative->addSigner($this);
        }

        return $this;
    }

    public function removeSignedInitiative(Initiative $signedInitiative): self
    {
        if ($this->signed_initiatives->contains($signedInitiative)) {
            $this->signed_initiatives->removeElement($signedInitiative);
            $signedInitiative->removeSigner($this);
        }

        return $this;
    }

    public function getPUser(): ?User
    {
        return $this->p_user;
    }

    public function setPUser(?User $p_user): self
    {
        $this->p_user = $p_user;

        // set (or unset) the owning side of the relation if necessary
        $newPeople = null === $p_user ? null : $this;
        if ($p_user->getPeople() !== $newPeople) {
            $p_user->setPeople($newPeople);
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setAuthor($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getAuthor() === $this) {
                $message->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getLikesMessages(): Collection
    {
        return $this->likes_messages;
    }

    public function addLikesMessage(Message $likesMessage): self
    {
        if (!$this->likes_messages->contains($likesMessage)) {
            $this->likes_messages[] = $likesMessage;
            $likesMessage->addLiker($this);
        }

        return $this;
    }

    public function removeLikesMessage(Message $likesMessage): self
    {
        if ($this->likes_messages->contains($likesMessage)) {
            $this->likes_messages->removeElement($likesMessage);
            $likesMessage->removeLiker($this);
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getDislikesMessages(): Collection
    {
        return $this->dislikes_messages;
    }

    public function addDislikesMessage(Message $dislikesMessage): self
    {
        if (!$this->dislikes_messages->contains($dislikesMessage)) {
            $this->dislikes_messages[] = $dislikesMessage;
            $dislikesMessage->addDisliker($this);
        }

        return $this;
    }

    public function removeDislikesMessage(Message $dislikesMessage): self
    {
        if ($this->dislikes_messages->contains($dislikesMessage)) {
            $this->dislikes_messages->removeElement($dislikesMessage);
            $dislikesMessage->removeDisliker($this);
        }

        return $this;
    }

    public function getTrustedLeader(): ?self
    {
        return $this->trusted_leader;
    }

    public function setTrustedLeader(?self $trusted_leader): self
    {
        $this->trusted_leader = $trusted_leader;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPrincipals(): Collection
    {
        return $this->principals;
    }

    public function addPrincipal(self $principal): self
    {
        if (!$this->principals->contains($principal)) {
            $this->principals[] = $principal;
            $principal->setTrustedLeader($this);
        }

        return $this;
    }

    public function removePrincipal(self $principal): self
    {
        if ($this->principals->contains($principal)) {
            $this->principals->removeElement($principal);
            // set the owning side to null (unless already changed)
            if ($principal->getTrustedLeader() === $this) {
                $principal->setTrustedLeader(null);
            }
        }

        return $this;
    }
}
