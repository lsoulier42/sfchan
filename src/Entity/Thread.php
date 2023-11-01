<?php

namespace App\Entity;

use App\Repository\ThreadRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Entity(repositoryClass: ThreadRepository::class)]
class Thread extends AbstractEntity
{
    #[Column(unique: true)]
    #[NotBlank()]
    private string $title;

    #[Column(type: Types::TEXT)]
    #[NotBlank()]
    private string $content;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'threads')]
    #[JoinColumn(nullable: false)]
    private User $author;

    #[ManyToOne(targetEntity: Board::class, inversedBy: 'threads')]
    #[JoinColumn(nullable: false)]
    private Board $board;

    

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
     * Get the value of author
     *
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param User $author
     *
     * @return self
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

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
}
