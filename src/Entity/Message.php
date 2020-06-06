<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
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
     * @ORM\ManyToOne(targetEntity=MessageGroup::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $message_group;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Message::class, inversedBy="answers")
     */
    private $reply;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="reply")
     */
    private $answers;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="likes_messages", )
     * @JoinTable(name="message_likes")
     */
    private $likers;

    /**
     * @ORM\ManyToMany(targetEntity=People::class, inversedBy="dislikes_messages")
     * @JoinTable(name="message_dislikes")
     */
    private $dislikers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->id = Uuid::uuid4();
        $this->likers = new ArrayCollection();
        $this->dislikers = new ArrayCollection();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getMessageGroup(): ?MessageGroup
    {
        return $this->message_group;
    }

    public function setMessageGroup(?MessageGroup $message_group): self
    {
        $this->message_group = $message_group;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAuthor(): ?People
    {
        return $this->author;
    }

    public function setAuthor(?People $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getReply(): ?self
    {
        return $this->reply;
    }

    public function setReply(?self $reply): self
    {
        $this->reply = $reply;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(self $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setReply($this);
        }

        return $this;
    }

    public function removeAnswer(self $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getReply() === $this) {
                $answer->setReply(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getLikers(): Collection
    {
        return $this->likers;
    }

    public function addLiker(People $liker): self
    {
        if (!$this->likers->contains($liker)) {
            $this->likers[] = $liker;
        }

        return $this;
    }

    public function removeLiker(People $liker): self
    {
        if ($this->likers->contains($liker)) {
            $this->likers->removeElement($liker);
        }

        return $this;
    }

    /**
     * @return Collection|People[]
     */
    public function getDislikers(): Collection
    {
        return $this->dislikers;
    }

    public function addDisliker(People $disliker): self
    {
        if (!$this->dislikers->contains($disliker)) {
            $this->dislikers[] = $disliker;
        }

        return $this;
    }

    public function removeDisliker(People $disliker): self
    {
        if ($this->dislikers->contains($disliker)) {
            $this->dislikers->removeElement($disliker);
        }

        return $this;
    }
}
