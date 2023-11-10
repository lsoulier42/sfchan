<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\BoardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Entity(repositoryClass: BoardRepository::class)]
class Board extends AbstractEntity
{
    #[Column(unique: true)]
    #[NotBlank]
    private string $title;

    #[Column]
    #[NotBlank]
    private string $description;

    /**
     * @var Collection<Thread> $threads
     */
    #[OneToMany(targetEntity: Thread::class, mappedBy: 'board')]
    private Collection $threads;

    public function __construct()
    {
        parent::__construct();
        $this->threads = new ArrayCollection();
    }

    /**
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
     * Get the value of description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of threads
     *
     * @return Collection<Thread>
     */
    public function getThreads(): Collection
    {
        return $this->threads;
    }

    /**
     * Set the value of threads
     *
     * @param Collection<Thread> $threads
     *
     * @return self
     */
    public function setThreads(Collection $threads): self
    {
        $this->threads = $threads;

        return $this;
    }

    /**
     * @param Thread $thread
     * @return self
     */
    public function addThread(Thread $thread): self
    {
        if (!$this->threads->contains($thread)) {
            $this->threads->add($thread);
        }
        $thread->setBoard($this);
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param Thread $thread
     * @return self
     */
    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
        }
        return $this;
    }
}
