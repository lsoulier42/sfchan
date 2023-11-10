<?php

namespace App\Entity;

use App\Repository\ThreadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Entity(repositoryClass: ThreadRepository::class)]
class Thread extends AbstractMessageEntity
{
    #[Column]
    #[NotBlank]
    private string $title;

    #[ManyToOne(targetEntity: Board::class, inversedBy: 'threads')]
    #[JoinColumn(nullable: false)]
    private Board $board;

    /**
     * @var Collection<Reply> $replies
     */
    #[OneToMany(targetEntity: Reply::class, mappedBy: 'thread')]
    private Collection $replies;

    public function __construct()
    {
        parent::__construct();
        $this->replies = new ArrayCollection();
    }

    /**
     * Get the value of board
     *
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * Set the value of board
     *
     * @param Board $board
     *
     * @return self
     */
    public function setBoard(Board $board): self
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of replies
     *
     * @return Collection<Reply>
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    /**
     * Set the value of replies
     *
     * @param Collection<Reply> $replies
     *
     * @return self
     */
    public function setReplies(Collection $replies): self
    {
        $this->replies = $replies;

        return $this;
    }

    /**
     * @param Reply $reply
     * @return self
     */
    public function addReply(Reply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies->add($reply);
        }
        $reply->setThread($this);
        return $this;
    }

    /**
     * @param Reply $reply
     * @return self
     */
    public function removeReply(Reply $reply): self
    {
        if ($this->replies->contains($reply)) {
            $this->replies->removeElement($reply);
        }
        return $this;
    }
}
