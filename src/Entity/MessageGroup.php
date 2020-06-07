<?php

namespace App\Entity;

use App\Repository\MessageGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=MessageGroupRepository::class)
 */
class MessageGroup
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
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="message_group", orphanRemoval=true)
     */
    private $messages;

    /**
     * @ORM\OneToOne(targetEntity=Petition::class, mappedBy="discussions", cascade={"persist", "remove"})
     */
    private $petition;

    /**
     * @ORM\OneToOne(targetEntity=Initiative::class, mappedBy="discussions", cascade={"persist", "remove"})
     */
    private $initiative;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->id = Uuid::uuid4();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
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
            $message->setMessageGroup($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getMessageGroup() === $this) {
                $message->setMessageGroup(null);
            }
        }

        return $this;
    }

    public function getPetition(): ?Petition
    {
        return $this->petition;
    }

    public function setPetition(?Petition $petition): self
    {
        $this->petition = $petition;

        // set (or unset) the owning side of the relation if necessary
        $newDiscussions = null === $petition ? null : $this;
        if ($petition->getDiscussions() !== $newDiscussions) {
            $petition->setDiscussions($newDiscussions);
        }

        return $this;
    }

    public function getInitiative(): ?Initiative
    {
        return $this->initiative;
    }

    public function setInitiative(?Initiative $initiative): self
    {
        $this->initiative = $initiative;

        // set (or unset) the owning side of the relation if necessary
        $newDiscussions = null === $initiative ? null : $this;
        if ($initiative->getDiscussions() !== $newDiscussions) {
            $initiative->setDiscussions($newDiscussions);
        }

        return $this;
    }
}
